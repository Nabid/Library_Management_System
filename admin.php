<?php
require_once('functions.php');
require_once("dbase.php");
essentials();
_header('admin::home');
_menu( "Welcome ".$_SESSION["name"]." : home", "index.php" );

$user = $_SESSION[ "name" ];
$err1 = "";
$err2 = "";
$err3 = "";

if( isset( $_POST["approve"] ) ) {
	header("Location: request.php");
}
 
if( isset( $_POST["return"] ) ) {
	header("Location: return.php");
}

if( isset( $_POST["addBook"] ) ) {
	if( findBook( $_POST["name"] ) == true ) {
		bookAdd( $_POST["name"], $_POST["price"], $_POST["info"], $_POST["copy"] );
		$err1 = "Successfully added.";
	} else {
		$err1 = "Already exists.";
	}
}

if( isset( $_POST["deleteBook"] ) ) {
	if( findBook( $_POST["name"] ) == false ) {
		bookDelete( $_POST["name"] );
		$err2 = "Successfully deleted.";
	} else {
		$err2 = "Book not found";
	}
}

if( isset( $_POST["modifyBook"] ) ) {
	if( findBook( $_POST["name"] ) == false ) {
		bookDelete( $_POST["name"], $_POST["price"], $_POST["info"], $_POST["copy"] );
		$err3 = "Successfully deleted.";
	} else {
		$err3 = "Book not found";
	}
}
?>

<table>
	<tr>
		<td> 
			<form action="admin.php" method="post">
				<input type="submit" name="approve" value="Approve Pending Registration">
			</form>
		</td>
		<td> 
			<form action="admin.php" method="post">
				<input type="submit" name="return" value="Approve return">
			</form>
		</td>
	</tr>
</table>

<form action="admin.php" method="post">
<fieldset>
	<legend>Add Book</legend>
	<input type="text" name="name" placeholder="book name" />
	<input type="text" name="price" placeholder="price" />
	<input type="text" name="info" placeholder="information" />
	<input type="text" name="copy" placeholder="copy" />
	<input type="submit" name="addBook" value="Add" />
	<?=$err1?>
</fieldset>
</form>

<form action="admin.php" method="post">
<fieldset>
	<legend>Delete Book</legend>
	<input type="text" name="name" placeholder="book name" />
	<input type="text" name="price" placeholder="price" />
	<input type="text" name="info" placeholder="information" />
	<input type="text" name="copy" placeholder="copy" />
	<input type="submit" name="deleteBook" value="Delete" />
	<?=$err2?>
</fieldset>
</form>

<form action="admin.php" method="post">
<fieldset>
	<legend>Modify Book</legend>
	<input type="text" name="name" placeholder="book name" />
	<input type="text" name="price" placeholder="price" />
	<input type="text" name="info" placeholder="information" />
	<input type="text" name="copy" placeholder="copy" />
	<input type="submit" name="modifyBook" value="Modify" />
	<?=$err3?>
</fieldset>
</form>

<?php
_footer();
?>