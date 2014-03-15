<?php
require_once('functions.php');
require_once("dbase.php");
essentials();
_header('User::Library Management System');

_menu( "Welcome ".$_SESSION["name"]." : home", "index.php" );

$err1 = "";

if( isset( $_POST["borrow"] ) ) {
	bookBorrow( $_POST["id"], $_SESSION["id"] );
}

if( isset( $_POST["cancel"] ) ) {
    bookBorrowRemove( $_POST["id"], $_SESSION["id"] );
}

if( isset( $_POST["confirm"] ) ) {
    confirmBorrow( $_SESSION["id"] );
}

$fine = userFine( $_SESSION["id"] );
echo " Fine: ".$fine."<br/>";

$result = bookList( $_SESSION["id"] );
$confirmation = bookConfirmCheck( $_SESSION["id"] );
?>

<!-- confirmation tag -->
<?php
if( mysql_num_rows( $confirmation ) > 0 ) {
?>
    <fieldset style="background-color:darkgrey">
        <legend>Confirm Borrow</legend>
<?php
    while( $row = mysql_fetch_assoc( $confirmation ) ) {
        $name = $row["name"];
        $id = $row["id"];
        $availibility = $row["availibility"];
        $info = $row["info"];
        $price = $row["price"];
?>
        <form action="user.php" method="post">
        <table>
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
                    <input type="submit" name="cancel" value="Cancel" />
                </td>
            </tr>
        </table>
        </form>
<?php
    }
?>
        <form action="user.php" method="post">
            <div align="center"> <input type="submit" name="confirm" value="Confirm" /> </div>
        </form>
    </fieldset>
<?php
}
?>
<!-- confirmation tag ends -->

<?php
if( mysql_num_rows( $result ) <= 0 ) {
    // No books available to borrow
    echo "Sorry, no books are available at this moment.";
} else {
?>
<!--
update: confirmation table,
user will select books then confirm.
-->
<b>Book List:</b>
<table border="1" width="100%">
    <tr>
        <th width="40px">ID</th>
        <th width="350px">Name</th>
        <th width="350px">Info</th>
        <th width="60px">Price</th>
        <th width="40px">Copy</th>
        <th align="center">Confirm</th>
    </tr>
</table>
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
                    <input type="hidden" name="total" />
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
}
?>


<?php
_footer();
?>