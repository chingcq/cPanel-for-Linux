<?
		$sql2 = "SELECT * FROM tbl_shop_config";
		$stmt2 = $this->registry['conn']->query($sql2);
		$obj2 = $stmt2->fetch(PDO::FETCH_OBJ);
		$shop_price = $obj2->shop_price;
?>
<div align=center>Get hosting for <? echo $shop_price; ?> - <a href=<? echo WEB_ROOT; ?>order>get it now</a></div>