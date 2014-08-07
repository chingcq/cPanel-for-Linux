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
$sql_2 ="SELECT * FROM log_pages WHERE log_ip = '" . $ip . "'";
$pages = new pages($this->registry);
$sql = $pages->setSQL($sql_2);
$result = $this->registry['conn']->query($sql);
$numrows = $result->rowCount();

?>
<table border="0" align="center" cellpadding="2" cellspacing="1" class="text" width="800px">
<table border="0" align="left" cellpadding="2" cellspacing="1" class="text" width="500px">
  <tr align="center" id="listTableHeader">
   <td>Page</td>
   <td>Date</td>
  </tr>
<?php
if ($numrows > 0) {	$i = 0;
	foreach ($this->registry['conn']->query($sql) as $row){
		print '<tr class=row1>';
		print '<td>' . $row['page_name'] . '</td>';
		print '<td width="120" align="center">' . $row['page_date'] . '</td>';
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
<table border="0" align="center" cellpadding="2" cellspacing="1" class="text" width="300px">
<tr id="listTableHeader"><td> Last five - referals</td></tr>
<?

$sql_2 = "SELECT * FROM log_user WHERE log_ip = '" . $ip . "' LIMIT 5";
$result = $this->registry['conn']->query($sql_2);
$numrows = $result->rowCount();

if ($numrows > 0) {
	$i = 0;
	foreach ($this->registry['conn']->query($sql_2) as $row){
		print '<tr class=row1>';
		print '<td>' . $row['log_referer'] . '</td>';
		print '</tr>';
	}
}
?>
<tr id="listTableHeader"><td>Last five - browsers</td></tr>
<?

$sql_2 = "SELECT * FROM log_user WHERE log_ip = '" . $ip . "' LIMIT 5";
$result = $this->registry['conn']->query($sql_2);
$numrows = $result->rowCount();

if ($numrows > 0) {
	$i = 0;
	foreach ($this->registry['conn']->query($sql_2) as $row){
		print '<tr class=row1>';
		print '<td>' . $row['log_browser'] . '</td>';
		print '</tr>';
	}
}
?>
</table>
<p>&nbsp;</p>