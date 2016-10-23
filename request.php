<?php
require_once('functions.php');
require_once("dbase.php");

essentials();
_header('Library Management System');
_menu( "Welcome ".$_SESSION["name"]." : home/requests", "admin.php" );

if( isset( $_POST["approve"] ) ) {
	newUserInsert( $_POST["id"], $_POST["name"], $_POST["pass"], $_POST["category"] );
	newUserDelete( $_POST["name"] );
}

if( isset( $_POST["deny"] ) ) {
	echo " deny ";
	newUserDelete( $_POST["name"] );
}

$result = newUserList();
?>

<?php
while( $row = mysqli_fetch_assoc( $result ) ) {
	$name = $row["name"];
	$id = $row["id"];
	echo $id."~";
	$pass = $row["password"];
?>		
	<form action="request.php" method="post">
	<table border="1" width="100%">
		<tr>
			<td width="50px">Id: <i><u> <?=$id?> </u></i> </td>
			<td width="300px">
				Name: <i><u> <?=$name?> </u></i> 
				<input type="hidden" name="name" value="<?=$name?>"/> 
				<input type="hidden" name="pass" value="<?=$pass?>"/> 
				<input type="hidden" name="id" value="<?=$id?>" /> 
			</td>
			<td align="center">
				<select name="category">
					<option value=1 name="category">User</option>
					<option value=0 name="category">Admin</option>
				</select>
			</td>
			<td align="center">
				<input type="submit" name="approve" value="Approve" />
			</td>
			<td align="center">
				<input type="submit" name="deny" value="Deny" />
			</td>
		</tr>
	</table>
	</form>
<?php
}
?>

<?php
_footer();
?>
