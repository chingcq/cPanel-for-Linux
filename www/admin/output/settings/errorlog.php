<?php
$myFile = SRV_ROOT . "log/errors.log";
if(isset($_POST['btn1']))
{
	$fh = fopen($myFile, 'a+');
	ftruncate($fh, 0);
	fclose($fh);
}

if(isset($_POST['btn']))
{
	$fh = fopen($myFile, 'a+');
	ftruncate($fh, 0);
	fwrite($fh, $_POST['mtxDescription']);
	fclose($fh);
}
$fh = fopen($myFile, 'r');
$theData = @fread($fh, filesize(@$myFile));
fclose($fh);

print "<form method=\"post\" name=\"frm\" id=\"frm\">\n";
print "<textarea cols=80 rows=20 name=mtxDescription id=mtxDescription>";
print nl2br($theData);
print "</textarea>";
print "<div align=center></p>";
print "<input name=\"btn1\" type=\"submit\" id=\"btn1\" value=\"Delete all\" class=\"box\">";
print "<input name=\"btn\" type=\"submit\" id=\"btn\" value=\"Save\" class=\"box\">";
print "</div>\n";
print "</form>";
?>