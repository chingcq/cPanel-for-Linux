<?php
print "<form method=\"post\" name=\"frm\" id=\"frm\">\n";
print "<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"1\" class=\"text\"> \n";
print "<tr align=\"left\" id=\"listTableHeader\">\n";
print "<td></td><td>\n";
print "Set price\n";
print "</td>\n";
print "</tr>\n";
print "<tr class=row1> \n";
print "<td width=150 class=\"label\">Set price*</td>\n";
print "<td class=\"content\"><input name=\"txtPrice\" type=\"text\" class=\"box\" id=\"txtPrice\" size=\"50\" maxlength=\"255\" value=$price></td>\n";
print "</tr>\n";
print "\n";
print "</table>\n";
print "<div align=center></p><input name=\"btn\" type=\"submit\" id=\"btn\" value=\"Save\" class=\"box\"></div>\n";
print "</form>\n";
?>