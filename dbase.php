<?php
$con = mysqli_connect( 'localhost', 'root', '', 'library' ); // databse connection
//mysqli_select_db( getDBConnection(), 'library' ); // selecting database

function getDBConnection() {
	return mysqli_connect( 'localhost', 'root', '', 'library' );
}

/** checks a user is already registered or not at registration.php page.
	returns true if user exists at user/newuser tables.
	returns false otherwise.
 */
function checkUser( $name ) {
	$query = "SELECT * FROM user WHERE name='$name'";
	$result = mysqli_query( getDBConnection(),  $query );
	if( mysqli_num_rows( $result ) == 1 ) return true; // username exists

	$query = "SELECT * FROM newuser WHERE name='$name'"; 
	$result = mysqli_query( getDBConnection(),  $query );
	if( mysqli_num_rows( $result ) == 1 ) return true; // username exists

	return false;
}

/*	this method registers an user at registration.php page. */
function registerUser( $uname, $pass ) {
	$query = "INSERT INTO `newuser` VALUES('', '$uname', '$pass')";
	mysqli_query( getDBConnection(),  $query );
}

/** *checks the user is an admin or not by checking its category.
	*validateUser() must be executed and if returns false only then this method should be called.
	*returns true if it is an user. returns false otherwise.
  */
function checkAdmin( $uname ) {
	//$uname = mysqli_real_escape_string( getDBConnection(), $uname );
	$query = "SELECT * FROM user WHERE name='$uname'";
	echo $query;
	$result = mysqli_query( getDBConnection(),  $query );
	$row = mysqli_fetch_assoc( $result );
	$_SESSION["name"] = $row["name"];
	$_SESSION["id"] = $row["id"];
	if( $row[ "category" ] == 0 ) return true; // admin
	return false; // user
}

/** this function check the username and password exists or not.
	also checks they match or not.
	returns true if they exists and matches.
	returns false otherwise. 
*/
function validateUser( $name, $pass ) {
	$query = "SELECT * FROM user WHERE name='$name' AND password=MD5('$pass')";
    //	echo $query;
	$result = mysqli_query( getDBConnection(),  $query );
	$rows = mysqli_fetch_assoc( $result );
	if( mysqli_num_rows( $result ) == 0 ) return false; // username or password doesn't match
	return true; // username and password match
}

/** returns all rows from newuser table in the database.
	in other words, returns all pending registration requests. 
 */	
function newUserList() {
	$query = "SELECT * FROM newuser";
	$result = mysqli_query( getDBConnection(),  $query );
	return $result;
}

/** denying a registered user by admin.
*/
function newUserDelete( $name ) {
	$query = "DELETE FROM newuser WHERE name='$name'";
	mysqli_query( getDBConnection(),  $query );
}

function newUserInsert( $id, $name, $pass, $category ) {
	$query = "INSERT INTO user VALUES( $id, '$name', '$pass', $category, 0 )";
	mysqli_query( getDBConnection(),  $query );
}

/**
 * @return books available, i.e number of copies > 0
 */
function bookList( $uid ) {
	$query = "SELECT * FROM book WHERE availibility > 0 AND id NOT IN ( SELECT bid from `transaction` WHERE uid='$uid' )" ;
	$result = mysqli_query( getDBConnection(),  $query );
	return $result;
}

/**
 * @param book id
 * @param user id
 * sets the books availibility one less.
 */
function bookBorrow( $bid, $uid ) {
	$query = "INSERT INTO `transaction` VALUES( '', $bid, $uid, SYSDATE(), '', 0 )";
	mysqli_query( getDBConnection(),  $query );
	$query = "UPDATE book SET availibility=availibility-1 where id='$bid'";
	mysqli_query( getDBConnection(),  $query );
}

/**
 * books to be borrowed confirmation check
 */
function bookConfirmCheck( $uid ) {
    $query = "SELECT * FROM book WHERE id in ( SELECT bid from `transaction` WHERE uid='$uid' AND confirm=0 )";
    $result = mysqli_query( getDBConnection(),  $query );
    return $result;
}

/**
 * cancels from confirmation list
 */
function bookBorrowRemove( $bid, $uid ) {
    $query = "DELETE FROM `transaction` WHERE uid='$uid' AND bid='$bid'";
    $result = mysqli_query( getDBConnection(),  $query );
    $query = "UPDATE book SET availibility=availibility+1 where id='$bid'";
    mysqli_query( getDBConnection(),  $query );
}

function confirmBorrow( $uid ) {
    $query = "UPDATE `transaction` SET confirm=1 WHERE uid='$uid'";
    mysqli_query( getDBConnection(),  $query );
}

function bookAdd( $name, $price, $info, $availibility ) {
	if( !is_string( $name ) ) {
		$name = ( string )$name;
	}

	$query = "INSERT INTO `book` VALUES( '', '".$name."', ".$price.", '".$info."', ".$availibility." )";
	echo $query."<br>";
	mysqli_query( getDBConnection(),  $query );
}

function findBook( $name ) {
	$query = "SELECT * FROM `book` WHERE name='$name'";
	$rs = mysqli_query($query);
	if( mysqli_num_rows($rs) == 0 ) return true;
	else return false;
}

function bookDelete( $bname ) {
	$query = "DELETE FROM book WHERE name='$bname'";
	mysqli_query( getDBConnection(),  $query );	
}

function bookModify( $name, $price, $info, $availibility ) {
	$query = "UPDATE book SET availibility='$availibility' price='$price' info='$info' where name='$name'";
	mysqli_query( getDBConnection(),  $query );	
}

function returnBookList() {
	$query = "SELECT * FROM `transaction` WHERE `borrow` > `rdate`";
	$result = mysqli_query( getDBConnection(),  $query );
	return $result;
}

function returnBooks( $bid, $uid ) {
	$query = "UPDATE `transaction` SET `rdate`=SYSDATE() WHERE `bid`=$bid AND `uid`=$uid";
	mysqli_query($query);
	$query = "UPDATE `book` SET `availibility`=availibility+1 WHERE `id`=$bid" ;
	mysqli_query( getDBConnection(),  $query );
	$query = "SELECT `rdate` - `borrow` AS fine FROM `transaction` WHERE `bid` =$bid AND `uid`=$uid";
	$res = mysqli_query($query);
	$res = mysqli_fetch_assoc( $res );
	$res = $res["fine"];
	//echo $res;
	if( $res > 3 ) {
		$res = ( $res - 3 ) * 20;
		$query = "SELECT `fine` FROM `user` WHERE `id` = $uid";
		$result = mysqli_query( getDBConnection(),  $query );
		//echo $query;
		$result = mysqli_fetch_assoc( $result );
		$res = $res + $result["fine"]; 
		$query = "UPDATE `user` SET `fine`=$res WHERE `id`=$uid";
		mysqli_query($query);
	}
	$query = "DELETE FROM `transaction` WHERE `bid` = $bid AND `uid` = $uid";
	mysqli_query($query);
}

function userFine( $uid ) {
	$query = "SELECT fine FROM user WHERE id = $uid";
	$result = mysqli_query( getDBConnection(),  $query );
	//echo $query;
	$result = mysqli_fetch_assoc( $result );
	return $result["fine"];
}
?>
