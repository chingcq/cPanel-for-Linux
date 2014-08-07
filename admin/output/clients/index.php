<script>
function deleteEntry(Id, url, tbl)
{
	if (confirm('Delete this entry?')) {
		window.location.href = '&action=deleteEntry&Id=' + Id;
	}
}
</script>
<?php
$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
    case 'deleteEntry' :
        deleteEntry();
        break;

    default :
}

function deleteEntry()
{
    if (isset($_GET['Id']) && (int)$_GET['Id'] > 0) {
        $Id = (int)$_GET['Id'];
    } else {
        header('Location: index.php');
    }


    $sql = "DELETE FROM buga WHERE user_id = '$Id'; DELETE FROM tbl_userinfo WHERE user_id = '$Id'";
	$conn = new PDO('mysql:host=localhost;dbname=hosting', 'root', '');
    $conn->query($sql);
}
$sql_2 = "SELECT * FROM `buga` ORDER BY 'user_id' DESC";
$pages = new pages($this->registry);
$sql = $pages->setSQL($sql_2);
$result = $this->registry['conn']->query($sql);
$numrows = $result->rowCount();
?>
<table border="0" align="center" cellpadding="2" cellspacing="1" class="text" width="800px">
  <tr align="center" id="listTableHeader">
   <td>User</td>
   <td width="70">Modify</td>
   <td width="70">Delete</td>
  </tr>
<?php
if ($numrows > 0) {	$i = 0;
	foreach ($this->registry['conn']->query($sql) as $row){		$sql2 = "SELECT * FROM buga WHERE user_id =" . $row['user_id'];
		$stmt2 = $this->registry['conn']->query($sql2);
		$obj2 = $stmt2->fetch(PDO::FETCH_OBJ);


		print '<tr class=row1>';
		print '<td><a href="' . WEB_ROOT . 'admin/clients/detail/&id=' . $row['user_id'] . '">' . $obj2->user_login . '</a></td>';
		print '<td width="70" align="center"><a href="' . WEB_ROOT . 'admin/clients/modify/&id=' . $row['user_id'] . '">Modify</a></td>';
		print '<td width="70" align="center"><a href="javascript:deleteEntry(' . $row['user_id'] . ');">Delete</a></td>';
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
   <td colspan="5" align="right"><input name="btn" type="button" id="btn" value="Add" class="box" onClick=location.href='<? echo WEB_ROOT; echo "admin/clients/add/"; ?>'></td>
  </tr>
</table>
<p>&nbsp;</p>