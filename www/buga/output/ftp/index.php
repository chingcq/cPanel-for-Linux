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
							'delete' 		=> array(	0 => 'tbl_ftp|ftp_id'));
				new process($this->registry, $array);
				echo "<script>document.location='" . WEB_ROOT . "buga/ftp/'</script>";
			break;
		}

$sql_2 = "SELECT * FROM `tbl_ftp` WHERE user_id = '" . $_SESSION['number'] . "'ORDER BY 'ftp_id' DESC";
$pages = new pages($this->registry);
$sql = $pages->setSQL($sql_2);
$result = $this->registry['conn']->query($sql);
$numrows = $result->rowCount();
?>
<table border="0" align="center" cellpadding="2" cellspacing="1" class="text" width="800px">
  <tr align="center" id="listTableHeader">
   <td>Domain name</td>
   <td>FTP user</td>
   <td width="70">Modify</td>
   <td width="70">Delete</td>
  </tr>
<?php
if ($numrows > 0) {
	foreach ($this->registry['conn']->query($sql) as $row){
		$stmt2 = $this->registry['conn']->query($sql2);
		$obj2 = $stmt2->fetch(PDO::FETCH_OBJ);

		$sql3 = "SELECT * FROM tbl_domain WHERE domain_id =" . $row['domain_id'];
		$stmt3 = $this->registry['conn']->query($sql3);
		$obj3 = $stmt3->fetch(PDO::FETCH_OBJ);
		print '<tr class=row1>';
		print '<td>' . $obj3->domain_name . '</td>';
		print '<td>' . $row['ftp_username'] . '</td>';
		print '<td width="70" align="center"><a href="' . WEB_ROOT . 'buga/ftp/modify/&id=' . $row['ftp_id'] . '">Modify</a></td>';
		print '<td width="70" align="center"><a href="javascript:deleteEntry(' . $row['ftp_id'] . ');">Delete</a></td>';
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
   <td colspan="5" align="right"><input name="btn" type="button" id="btn" value="Add" class="box" onClick=location.href='<? echo WEB_ROOT; echo "buga/ftp/add/"; ?>'></td>
  </tr>
</table>
<p>&nbsp;</p>