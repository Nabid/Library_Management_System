<?php
require_once('functions.php');
require_once("dbase.php");
essentials();
_header('User::Library Management System');

_menu( "Welcome ".$_SESSION["name"]." : home", "index.php" );


if( isset( $_POST["borrow"] ) ) {
	bookBorrow( $_POST["id"], $_SESSION["id"] );
}

$fine = userFine( $_SESSION["id"] );
echo " Fine: ".$fine."<br/>";

$result = bookList();
?>

<b>Book List</b>
<?php
while( $row = mysql_fetch_assoc( $result ) ) {
	$name = $row["name"];
	$id = $row["id"];
	$availibility = $row["availibility"];
	$info = $row["info"];
	$price = $row["price"];
?>		
	<form action="user.php" method="post">
	<table border="1" width="100%">
		<tr>
			<td width="40px"><i><u> <?=$id?> </u></i> </td>
			<td width="350px">
				<i><u> <?=$name?> </u></i> 
				<input type="hidden" name="name" value="<?=$name?>"/> 
				<input type="hidden" name="availibility" value="<?=$availibility?>"/> 
				<input type="hidden" name="id" value="<?=$id?>" /> 
				<input type="hidden" name="info" value="<?=$info?>" /> 
				<input type="hidden" name="price" value="<?=$price?>" /> 
			</td>
			<td width="350px"><i><u> <?=$info?> </u></i> </td>
			<td width="60px"><i><u> <?=$price?> </u></i> </td>
			<td width="40px"><i><u> <?=$availibility?> </u></i> </td>
			<td align="center">
				<input type="submit" name="borrow" value="Borrow" />
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