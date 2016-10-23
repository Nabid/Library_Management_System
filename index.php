<?php
require_once('functions.php');
require_once("dbase.php");
//essentials();
session_start();
_header('Library Management System');

$err = "";
if( isset( $_POST["submit"] ) ){
	$name = mysqli_real_escape_string( $con, trim( $_POST["uname"] ) );
	$pass = $_POST["upass"];
	$res = validateUser( $name, $pass );
	if( $res == false ) { // username or password doesn't match
		$err = "Username or password does not match.";
	} else { // username and password matches andchecking for admin 
		$res = checkAdmin( $name );
		//$_SESSION["name"] = $name;
		//$_SESSION["id"] = $row["id"];
		//echo $_SESSION["name"];
		if( $res == true ) { // uses is a admin
			//echo true;
			header( "Location: admin.php" );
		} else { // not an admin, redirecting to user page
			//echo false;
			header( "Location: user.php" );
		}
	}
}

// register button page.
if( isset( $_POST['register'] ) ) {
	header( "Location: registration.php" );
}
?>
<table border='0'>
	<tr>
		<td>
			<img src='images/welcome.jpg' alt="Welcome" width="480" height="300"/>
		</td>
		<td width='480px' align='center'>
			<form action='index.php' method='post'>
			<table border='0'>
				<tr>
					<td colspan="2"style="color:red"><?=$err?></td>
				</tr>
				<tr>
					<td colspan="2"><input type="text" name="uname" placeholder="User Name"/></td>
				</tr>
				<tr>
					<td colspan="2"><input type="password" name="upass" placeholder="Password" /></td>
				</tr>
				<tr>
					<td>
						<input type="submit" name="submit" value="Log In" />
					</td>
					<td>
						<input type="submit" name="register" value="Register" />
					</td>
				</tr>
			</table>
			</form>
		</td>
	</tr>
</table>
<?php
_footer();
?>
