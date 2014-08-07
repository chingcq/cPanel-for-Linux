<?php
if(isset($_POST['submit']))
{
$validate = new validation;
if(!$validate->check($_POST['string'], $_POST['check']))
{
  		print "Error";
}
else
{
                       print “Success”;
}
}
print "<form action=\"\" method=\"post\">";
print "String to check: <input name=\"string\" type=\"text\">";
print "<br>"; 
print "Case to use: <input name=\"check\" type=\"text\">"; 
print "<br>"; 
print "<input type=\"submit\" name=\"submit\" value=\"submit\">";
print "</form>";
?>
<?php echo $message; ?><br>
Hello back :).<br>
<?php
$sql = "SELECT * FROM tbl_ftp";
foreach ($this->registry['conn']->query($sql) as $row){
print $row['ftp_id'] .' - '. $row['ftp_username'] . '<br />';
}
echo $_SERVER['REQUEST_URI'];
echo $_SESSION['watcher'];
echo SRV_ROOT;
?>
<img src="<? echo WEB_ROOT; ?>admin/temp/verify.png"><br>
<img src="<? echo WEB_ROOT; ?>admin/temp/bar-graph.png"><br>
<img src="<? echo WEB_ROOT; ?>admin/temp/pred-bar-graph.png">