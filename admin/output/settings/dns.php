<?php
print "<form method=\"post\" name=\"frm\" id=\"frm\">\n";
print "<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"1\" class=\"text\"> \n";
print "<tr align=\"left\" id=\"listTableHeader\">\n";
print "<td></td><td>\n";
print $message;
print "</td>\n";
print "</tr>\n";
print "</tr>\n";
print "<tr class=row1> \n";
print "<td width=150 class=\"label\">IP*</td>\n";
print "<td class=\"content\"><input name=\"dns_ip\" type=\"text\" class=\"box\" id=\"dns_ip\" size=\"50\" maxlength=\"255\" value=$dns_ip></td>\n";
print "</tr>\n";
print "\n";
print "</table>\n";
print "<div align=center></p><input name=\"btn\" type=\"submit\" id=\"btn\" value=\"Add\" class=\"box\"></div>\n";
print "</form>\n";
?>
