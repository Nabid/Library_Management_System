<?php
require_once('functions.php');
require_once('dbase.php');
//essentials();
_header('Library Management System');

if( isset($_POST['submit']) ) {
	$err1 = "";
	$err3 = "";
	$err4 = "";
	$name = mysqli_real_escape_string( getDBConnection(), $_POST['uname'] );
	$pass = $_POST['upass'];
	if( $name == "" || $pass == "" ) { // username or password field empty.
		if( $name == "" ) $err1 = "<span style='color:red'>Name can not be empty.</span>";
		if( $pass == "" ) $err3 = "<span style='color:red'>Password can not be empty.</span>";
	} else { 
		$result = checkUser( $name );
		// username in use.
		if( $result == true ) echo "<span style='color:red'>User name already in use. Please choose different user name.</span>";
		else { // registration successfull.
			registerUser( $name, $pass );
			$name = "";
			echo "<span style='color:Green'>Successfully registered.</span>";
		}
	}
}

// go back button onClick
if( isset( $_POST["home"] ) ) {
	header( "Location: index.php" );
}
?>
<form action='registration.php' method='post'>
<table>
	<tr>
		<td colspan='3'> <?@$err4?> </td>
	</tr>
	<tr>
		<td align='right'>User name:</td>
		<td><input type='text' name='uname' value="<?=@$_POST['uname']?>" /></td>
		<td><?=@$err1?></td>
	</tr>
	<tr>
		<td align='right'>Password:</td>
		<td><input type='password' name='upass'/></td>
		<td><?=@$err3?></td>
	</tr>
	<tr>
		<td></td>
		<td>
			<input type='submit' name='submit' value='Confirm Registration'/>	
		</td>
		<td>
			<input type='submit' name='home' value='Go Back'/>	
		</td>
	</tr>
</table>
</form>
<?php
_footer();
?>
