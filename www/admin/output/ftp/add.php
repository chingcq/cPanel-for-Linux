<?php
print "<form method=\"post\" name=\"frm\" id=\"frm\">\n";
print "<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"1\" class=\"text\"> \n";
print "<tr align=\"left\" id=\"listTableHeader\">\n";
print "<td></td><td>\n";
print $message;
print "</td>\n";
print "</tr>\n";
print "<tr class=row1> \n";
print "<td width=150 class=\"label\">FTP username*</td>\n";
print "<td class=\"content\"><input name=\"txtFTP\" type=\"text\" class=\"box\" id=\"txtFTP\" size=\"50\" maxlength=\"255\"></td>\n";
print "</tr>\n";
print "<tr class=row1> \n";
print "<td width=150 class=\"label\">FTP password*</td>\n";
print "<td class=\"content\"><input name=\"txtFTPpass\" type=\"password\" class=\"box\" id=\"txtFTPpass\" size=\"50\" maxlength=\"255\"></td>\n";
print "</tr>\n";
print "<tr class=row1> \n";
print "<td width=150 class=\"label\">Domain ID*</td>\n";
print "<td class=\"content\"><input name=\"txtDomain\" type=\"text\" class=\"box\" id=\"txtDomain\" size=\"50\" maxlength=\"255\"></td>\n";
print "</tr>\n";
print "<tr class=row1> \n";
print "<td width=150 class=\"label\">User ID*</td>\n";
print "<td class=\"content\"><input name=\"txtID\" type=\"text\" class=\"box\" id=\"txtID\" size=\"50\" maxlength=\"100\"></td>\n";
print "</tr>\n";
print "\n";
print "</table>\n";
print "<div align=center></p><input name=\"btn\" type=\"submit\" id=\"btn\" value=\"Add\" class=\"box\"></div>\n";
print "</form>\n";
?>