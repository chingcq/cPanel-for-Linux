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
							'delete' 		=> array(	0 => 'records|id'));
				new process($this->registry, $array);
				echo "<script>document.location='" . WEB_ROOT . "admin/dns/detail'</script>";
			break;
		}
		$Id = $_SESSION['dns'];
$sql2 = "SELECT * FROM domains WHERE id = '$Id'";
$stmt2 = $this->registry['conn']->query($sql2);
$obj2 = $stmt2->fetch(PDO::FETCH_OBJ);
$Id2 = $obj2->name;

$sql_2 = "SELECT * FROM `records` WHERE domain_id = '$Id' ORDER BY 'id' DESC";
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
if ($numrows > 0) {	$i = 0;
	foreach ($this->registry['conn']->query($sql) as $row){
		print '<tr class=row1>';
		print '<td>' . $Id2 . '</a></td>';
		print '<td>' . $row['name'] . '</td>';
		print '<td>' . $row['type'] . '</td>';
		print '<td>' . $row['content'] . '</td>';
		print '<td width="70" align="center"><a href="' . WEB_ROOT . 'admin/dns/modify/&id=' . $row['id'] . '">Modify</a></td>';
		print '<td width="70" align="center"><a href="javascript:deleteEntry(' . $row['id'] . ');">Delete</a></td>';
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
