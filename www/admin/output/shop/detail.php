<?php
/*
##########################################################################
#                                                                        #
# 		WWW		 	   WWW EEEEEEEEEE BBBBBBBB             AAA			 #
#		 WWW	WW	  WWW  EEE		  BB    BB            AAAAA			 #
#         WWW  WWWW  WWW   EEEEEE     BBBBBBB   -----    AA   AA		 #
#          WWWWWWWWWWWW    EEE        BB    BB          AAAAAAAAA		 #
#			WWWW  WWWW     EEEEEEEEEE BBBBBBBB         AAA     AAA		 #
#   Copyright 2008-current date by web-a.org.uk, Web-Assistants          #
#                                                                        #
#   visit web-a.org, to find out more about our services                 #
#   - Script runs under the GNU GENERAL PUBLIC LICENSE                   #
#   - It's NOT allowed to remove this copyright-tag                      #
#   -- http://www.fsf.org/licensing/licenses/gpl.html                    #
#                                                                        #
#   Far Development by Development Team - web-a.org.uk                   #
#                                                                        #
#   visit web-a.org.uk                                                   #
#                                                                        #
##########################################################################
*/
if (!defined('WEB_ROOT')) {
    exit;
}

// make sure a article id exists
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $orderId = $_GET['id'];
} else {
    // redirect to index.php if product id is not present
    header('Location: index.php');
}

if(isset($_POST['btnModify']))
{
	$query = "UPDATE tbl_order SET order_status ='" . $_POST['cboCategory'] . "' WHERE order_id= $orderId";
	$this->registry['conn']->query($query);
}


if(isset($_POST['btnMemo']))
{
	$query = "UPDATE tbl_order SET order_memo ='" . $_POST['mtxDescription'] . "' WHERE order_id= $orderId";
	$this->registry['conn']->query($query);
}
// get ordered items
$sql = "SELECT *
        FROM tbl_order oi, tbl_order_length p, tbl_shop_config c, tbl_subscribe k
        WHERE oi.order_id = p.order_id and oi.order_id = $orderId
        ORDER BY oi.order_id ASC";
$stmt = $this->registry['conn']->query($sql);
$result = $stmt->fetch(PDO::FETCH_OBJ);

?>
<form action="" method="post" name="frmAddOrder" id="frmAddOrder">
    <table width="550" border="0"  align="center" cellpadding="5" cellspacing="1" class="detailTable">
        <tr>
            <td colspan="2" align="center" id="infoTableHeader">Order detail</td>
        </tr>
        <tr>
            <td width="150" class="label">Order number</td>
            <td class="content"><?php echo $orderId; ?></td>
        </tr>
        <tr>
            <td width="150" class="label">Buyer</td>
            <td class="content"><?php echo $result->user_id; ?> (<a href=<? echo WEB_ROOT; ?>admin/clients/detail/&id=<? echo $result->user_id; ?> target=_blank>view profile</a>)</td>
        </tr>
        <tr>
            <td width="150" class="label">Order date</td>
            <td class="content"><?php echo $result->order_date; ; ?></td>
        </tr>
        <tr>
            <td width="150" class="label">Last update</td>
            <td class="content"><?php echo $result->order_date; ?></td>
        </tr>
        <tr>
            <td class="label">Status</td>
            <td class="content">
			<form action="" method="post" name="frmAddOrder" id="frmAddOrder">
			<select name="cboCategory" id="cboCategory" class="box">
    <option value="<?php echo $result->order_status; ?>" selected><?php echo $result->order_status; ?></option>
	<option value="New">New</option>
	<option value="Payed">Payed</option>
	<option value="Complited">Complited</option>
	<option value="Canceled">Canceled</option>
    </select><input name="btnModify" type="submit" id="btnModify" value="Change status" class="box"></form></td>
        </td>
        </tr>
    </table>
</form>
<p>&nbsp;</p>
<table width="550" border="0"  align="center" cellpadding="5" cellspacing="1" class="detailTable">
    <tr id="infoTableHeader">
        <td colspan="3">Ordered products</td>
    </tr>
    <tr align="center" class="label">
        <td>Products</td>
        <td>Price per item</td>
        <td>Total</td>
    </tr>
    <tr class="content">
        <td><?php echo $result->order_length_mont . " X " . $result->shop_price; ?></td>
        <td align="right"><?php echo $result->shop_price; ?></td>
        <td align="right"><?php echo $subTotal = $result->order_length_mont * $result->shop_price; ?></td>
    </tr>
	   <tr class="content">
        <td colspan="2" align="right">tax</td>
        <td align="right"><?php echo "17.5%" ?></td>
    </tr>
    <tr class="content">
        <td colspan="2" align="right">Total</td>
        <td align="right"><?php echo $subTotal*1.175; ?></td>
    </tr>
</table>
<p>&nbsp;</p>
<table width="550" border="0"  align="center" cellpadding="5" cellspacing="1" class="detailTable">
    <tr id="infoTableHeader">
        <td colspan="2">Information about buyer</td>
    </tr>
    <tr>
        <td colspan="2" class="label"><form action="" method="post" name="frmAddOrder" id="frmAddOrder"><textarea cols=64 name="mtxDescription" id="mtxDescription"><?php echo nl2br($result->order_memo); ?></textarea><input name="btnMemo" type="submit" id="btnMemo" value="Save" class="box"></form></td>
    </tr>
</table>
<p>&nbsp;</p>
<p align="center">
    <input name="btnBack" type="button" id="btnBack" value="Back(Назад)" class="box" onClick="window.history.back();">
</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
