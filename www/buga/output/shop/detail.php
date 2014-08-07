<?php

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
// get ordered items
$sql = "SELECT *
        FROM tbl_order oi, tbl_order_length p, tbl_shop_config c, tbl_subscribe k
        WHERE oi.order_id = p.order_id AND oi.order_id = $orderId AND oi.user_id = '" . $_SESSION['number'] . "'
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
            <td width="150" class="label">Order date</td>
            <td class="content"><?php echo $result->order_date; ; ?></td>
        </tr>
        <tr>
            <td width="150" class="label">Last update</td>
            <td class="content"><?php echo $result->order_date; ?></td>
        </tr>
        <tr>
            <td class="label">Status</td>
            <td class="content"><?php echo $result->order_status; ?></td>
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
        <td colspan="2">Extra information</td>
    </tr>
    <tr>
        <td colspan="2" class="label"><?php echo nl2br($result->order_memo); ?></td>
    </tr>
</table>
<p>&nbsp;</p>
<p align="center">
    <input name="btnBack" type="button" id="btnBack" value="Back" class="box" onClick="window.history.back();">
</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
