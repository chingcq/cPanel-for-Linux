<?
$sql_2 = "SELECT * FROM `log_user` ORDER BY 'log_id' DESC";
$pages = new pages($this->registry);
$sql = $pages->setSQL($sql_2);
$result = $this->registry['conn']->query($sql);
$numrows = $result->rowCount();
?>
<table border="0" align="center" cellpadding="2" cellspacing="1" class="text" width="800px">
  <tr align="center" id="listTableHeader">
   <td>#</td>
   <td>IP</td>
   <td>Referer</td>
   <td>Browser</td>
  </tr>
<?php
if ($numrows > 0) {
	$i = 0;
	foreach ($this->registry['conn']->query($sql) as $row){
		print '<tr class=row1>';
		print '<td>' . $row['log_id'] . '</td>';
		print '<td><a href=' . WEB_ROOT . 'admin/settings/detail/&ip=' . $row['log_ip'] . '>' . $row['log_ip'] . '</a></td>';
		print '<td>' . $row['log_referer'] . '</td>';
		print '<td>' . $row['log_browser'] . '</td>';
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
   <td colspan="5" align="right"><input name="btn" type="button" id="btn" value="Add" class="box" onClick=location.href='<? echo WEB_ROOT; echo "admin/ftp/add/"; ?>'></td>
  </tr>
</table>
<p>&nbsp;</p>