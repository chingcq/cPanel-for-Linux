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
							'delete' 		=> array(	0 => 'users|email_id'));
				new process($this->registry, $array); 
				echo "<script>document.location='" . WEB_ROOT . "admin/mail/'</script>"; 
			break;
		}

$sql_2 = "SELECT * FROM `users` ORDER BY 'email_id' DESC";
$pages = new pages($this->registry);
$sql = $pages->setSQL($sql_2);
$result = $this->registry['conn']->query($sql);
?>
<table border="0" align="center" cellpadding="2" cellspacing="1" class="text" width="800px">
  <tr align="center" id="listTableHeader">
   <td>User</td>
   <td>Domain name</td>
   <td>Email</td>
   <td width="70">Modify</td>
   <td width="70">Delete</td>
  </tr>
<?php


if(@$result->rowCount() > 0) 
{	
	$i = 0;
	foreach ($this->registry['conn']->query($sql) as $row)
	{		
		$sql2 = "SELECT * FROM buga WHERE user_id =" . $row['user_id'];
		$stmt2 = $this->registry['conn']->query($sql2);
		$obj2 = $stmt2->fetch(PDO::FETCH_OBJ);

		$sql3 = "SELECT * FROM domains WHERE id =" . $row['domain_id'];
		$stmt3 = $this->registry['conn']->query($sql3);
		$obj3 = $stmt3->fetch(PDO::FETCH_OBJ);
		print '<tr class=row1>';
		print '<td><a href="' . WEB_ROOT . 'admin/clients/detail/&id=' . $row['user_id'] . '">' . $obj2->user_login . '</a></td>';
		print '<td>' . $obj3->name . '</td>';
		print '<td>' . $row['email'] . '</td>';
		print '<td width="70" align="center"><a href="' . WEB_ROOT . 'admin/mail/modify/&id=' . $row['email_id'] . '">Modify</a></td>';
		print '<td width="70" align="center"><a href="javascript:deleteEntry(' . $row['email_id'] . ');">Delete</a></td>';
		print '</tr>';
	}
	
	print '<tr>
			<td colspan="5" align="center">';

	$pages->pages($sql_2);

	print '</td>
			</tr>';
}else{
	print '<tr>
			<td colspan="5" align="center">No entries</td>
		   </tr>';
}
?>
  <tr>
   <td colspan="5">&nbsp;</td>
  </tr>
  <tr>
   <td colspan="5" align="right"><input name="btn" type="button" id="btn" value="Add" class="box" onClick=location.href='<? echo WEB_ROOT; echo "admin/mail/add/"; ?>'></td>
  </tr>
</table>
<p>&nbsp;</p>