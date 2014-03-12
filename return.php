<?php
require_once("functions.php");
require_once( "dbase.php" );

essentials();
_header('Library Management System');
_menu( "Welcome ".$_SESSION["name"]." : home/return", "admin.php" );

if( isset( $_POST["return"] ) ) {
	$bid = $_POST["bid"];
	$uid = $_POST["uid"];
	returnBooks( $bid, $uid );
}

$result = returnBookList();
?>

<?php
while( $row = mysql_fetch_assoc( $result ) ) {
	$bid = $row["bid"];
	$uid = $row["uid"];
	$bdate = $row["borrow"];
?>		
	<form action="return.php" method="post">
	<table border="1" width="100%">
		<tr>
			<td width="50px"><i><u> <?=$bid?> </u></i> </td>
			<td width="300px">
				<i><u> <?=$uid?> </u></i> 
				<input type="hidden" name="bid" value="<?=$bid?>"/> 
				<input type="hidden" name="uid" value="<?=$uid?>"/> 
				<input type="hidden" name="bdate" value="<?=$bdate?>" /> 
			</td>
			<td align="center">
				<input type="submit" name="return" value="Return Back" />
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