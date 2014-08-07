<?php
print "<form method=\"post\" name=\"frm\" id=\"frm\">\n";
print "<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"1\" class=\"text\">\n";
print "<tr align=\"left\" id=\"listTableHeader\">\n";
print "<td></td><td>\n";
print $message;
print "</td>\n";
print "</tr>\n";
print "<tr class=row1>\n";
print "<td width=150 class=\"label\">MySQL user*</td>\n";
print "<td class=\"content\"><input name=\"txtmysql\" type=\"text\" class=\"box\" id=\"txtmysql\" size=\"50\" maxlength=\"255\" value=\"$ftp_username2\"></td>\n";
print "</tr>\n";
print "<tr class=row1>\n";
print "<td width=150 class=\"label\">Domain ID*</td>\n";
print "<td class=\"content\"><input name=\"txtDomain\" type=\"text\" class=\"box\" id=\"txtDomain\" size=\"50\" maxlength=\"255\" value=\"$domain_id2\"></td>\n";
print "</tr>\n";
print "<tr class=row1>\n";
print "<td width=150 class=\"label\">User ID*</td>\n";
print "<td class=\"content\"><input name=\"txtID\" type=\"text\" class=\"box\" id=\"txtID\" size=\"50\" maxlength=\"100\" value=\"$user_id2\"></td>\n";
print "</tr>\n";
print "\n";
print "</table>\n";
print "<div align=center></p><input name=\"btn\" type=\"submit\" id=\"btn\" value=\"Modify\" class=\"box\"></div>\n";
print "</form>\n";
?>
