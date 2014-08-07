<?php
print "<form method=\"post\" name=\"frm\" id=\"frm\">\n";
print "<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"1\" class=\"text\"> \n";
print "<tr align=\"left\" id=\"listTableHeader\">\n";
print "<td></td><td>\n";
print $message;
print "</td>\n";
print "</tr>\n";
print "<tr class=row1> \n";
print "<td width=150 class=\"label\">Username*</td>\n";
print "<td class=\"content\"><input name=\"txtusername\" type=\"text\" class=\"box\" id=\"txtusername\" size=\"50\" maxlength=\"255\"></td>\n";
print "</tr>\n";
print "<tr class=row1> \n";
print "<td width=150 class=\"label\">Password*</td>\n";
print "<td class=\"content\"><input name=\"txtpass\" type=\"password\" class=\"box\" id=\"txtpass\" size=\"50\" maxlength=\"255\"></td>\n";
print "</tr>\n";
print "<tr class=row1> \n";
print "<td width=150 class=\"label\">Repeat password*</td>\n";
print "<td class=\"content\"><input name=\"txtrepass\" type=\"password\" class=\"box\" id=\"txtrepass\" size=\"50\" maxlength=\"255\"></td>\n";
print "</tr>\n";
print "\n";
print "</table>\n";
print "<div align=center></p><input name=\"btn\" type=\"submit\" id=\"btn\" value=\"Add\" class=\"box\"></div>\n";
print "</form>\n";
?>