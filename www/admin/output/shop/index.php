<?php
$sql_2 = "SELECT * FROM `tbl_order` ORDER BY 'order_id' DESC";
$pages = new pages($this->registry);
$sql = $pages->setSQL($sql_2);
$result = $this->registry['conn']->query($sql);
$numrows = $result->rowCount();
?>
<table border="0" align="center" cellpadding="2" cellspacing="1" class="text" width="800px">
  <tr align="center" id="listTableHeader">
   <td>Order #</td>
   <td>User</td>
   <td>Amount</td>
   <td>Order date</td>
   <td>Status</td>
  </tr>
<?php
if ($numrows > 0) {	$i = 0;
	foreach ($this->registry['conn']->query($sql) as $row){		$sql2 = "SELECT * FROM buga WHERE user_id =" . $row['user_id'];
		$stmt2 = $this->registry['conn']->query($sql2);
		$obj2 = $stmt2->fetch(PDO::FETCH_OBJ);
		
		$sql3 = "SELECT * FROM tbl_order_length WHERE order_id =" . $row['order_id'];
		$stmt3 = $this->registry['conn']->query($sql3);
		$obj3 = $stmt3->fetch(PDO::FETCH_OBJ);
		print '<tr class=row1>';
		print '<td width=10px><a href="' . WEB_ROOT . 'admin/shop/detail/&id=' . $row['order_id'] . '">' . $row['order_id'] . '</a></td>';
		print '<td><a href="' . WEB_ROOT . 'admin/clients/detail/&id=' . $row['user_id'] . '">' . $obj2->user_login . '</a></td>';
		print '<td>' . $obj3->order_length_mont . ' month</td>';
		print '<td>' . $row['order_date'] . '</td>';
		print '<td>' . $row['order_status'] . '</td>';
		print '</tr>';
	}
?>
  <tr>
   <td colspan="5" align="center">
<?php
	$pages->pages($sql_2);
?>
   </td>
  </tr>
<?php
}
else
{
?>
  <tr>
   <td colspan="5" align="center">No entries</td>
  </tr>
<?php
}
?>
  <tr>
   <td colspan="5">&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>