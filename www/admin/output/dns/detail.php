<?php
?>
<script>
function deleteEntry(Id, url, tbl)
{
	if (confirm('Delete this entry?')) {
		window.location.href = '&action=deleteEntry&Id=' + Id;
	}
}
</script>
<?
 		$action = isset($_GET['action']) ? $_GET['action'] : '';
		switch ($action) {
			case 'deleteEntry' :
				$array = array('type' 			=> 'delete',
							'delete' 		=> array(	0 => 'tbl_records|record_id'));
				new process($this->registry, $array);
				echo "<script>document.location='" . WEB_ROOT . "admin/dns/detail'</script>";
			break;
		}
		$Id = $_SESSION['dns'];
$sql2 = "SELECT * FROM tbl_domain WHERE domain_id = '$Id'";
$stmt2 = $this->registry['conn']->query($sql2);
$obj2 = $stmt2->fetch(PDO::FETCH_OBJ);
$Id2 = $obj2->domain_name;

$sql_2 = "SELECT * FROM `tbl_records` WHERE domain_name = '$Id2' ORDER BY 'record_id' DESC";
$pages = new pages($this->registry);
$sql = $pages->setSQL($sql_2);
$result = $this->registry['conn']->query($sql);
$numrows = $result->rowCount();
?>
<table border="0" align="center" cellpadding="2" cellspacing="1" class="text" width="800px">
  <tr align="center" id="listTableHeader">
   <td>Domain Name</td>
   <td>DNS Name</td>
   <td>Record type</td>
   <td>Record name</td>
   <td width="70">Modify</td>
   <td width="70">Delete</td>
  </tr>
<?php
if ($numrows > 0) {	$i = 0;
	foreach ($this->registry['conn']->query($sql) as $row){
		print '<tr class=row1>';
		print '<td>' . $row['domain_name'] . '</a></td>';
		print '<td>' . $row['dns_name'] . '</td>';
		print '<td>' . $row['record_type'] . '</td>';
		print '<td>' . $row['record_name'] . '</td>';
		print '<td width="70" align="center"><a href="' . WEB_ROOT . 'admin/dns/modify/&id=' . $row['record_id'] . '">Modify</a></td>';
		print '<td width="70" align="center"><a href="javascript:deleteEntry(' . $row['record_id'] . ');">Delete</a></td>';
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
  <tr>
   <td colspan="5" align="right"><input name="btn" type="button" id="btn" value="Add" class="box" onClick=location.href='<? echo WEB_ROOT; echo "admin/dns/add/"; ?>'></td>
  </tr>
</table>
<p>&nbsp;</p>