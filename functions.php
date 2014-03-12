<?php
// function needs to be add very first of page
function essentials(){
	session_start();
	if( !isset( $_SESSION["name"] ) ) {
		header('Location: logout.php');
	}
}
?>
<?php
function _header( $title ) {
?>
<!DOCTYPE HTML>
<html>
<head>
	<title><?=$title?></title>
</head>
<body>
	<table width='960px' align='center' border='0'>
		<tr style='background-color:SteelBlue '>
			<td align='center' valign='center' style='color:white'><h1><span style='color:red'>L</span>ibrary <span style='color:red'>M</span>anagement <span style='color:red'>S</span>ystem</h1></td>
		</tr>
		<tr>
			<td>
<?php
}
function _footer() {
?>
			</td>
		</tr>
		<tr>
			<td><hr/></td>
		</tr>
		<tr>
			<td align='center' style='color:SteelBlue'>
				<i>copyright &#169; Md. Nabid Imteaj</i>
			</td>
		</tr>
	</table>
</body>
</html>
<?php
}
?>

<?php
function _menu( $message, $back ) {
	?>
<!-- menu bar -->
<hr/>
<table>
	<tr>
		<td align="left" width="480px"><?=$message?></td>
		<td align="right" width="480px"> <a href="<?=$back?>">Go Back</a> <a href="logout.php">log out</a></td>
	</tr>
</table>
<hr/>
<!-- menu bar -->
<?php
}
?>