<?php
print "<table border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"1\" class=\"text\" width=\"800px\" valign=\"top\">\n";
print "  <tr align=\"center\" id=\"listTableHeader\" valign=\"top\">\n";
print "   <td valign=\"top\">\n";
print "<a href=" . WEB_ROOT . "admin/settings/stats/&stats=pages>Most viewed pages</a> |\n";
print "<a href=" . WEB_ROOT . "admin/settings/stats/&stats=browsers>Used browsers</a> |\n";
print "<a href=" . WEB_ROOT . "admin/settings/stats/&stats=segments>Hard drive data segments</a> |\n";
print "<a href=" . WEB_ROOT . "admin/settings/stats/&stats=visits>Visits</a></td>\n";
print "  </tr>\n";
print "<tr  valign=top><td  style='vertical-align:top;'>\n";
print "<div align=center>\n";
print $display;
print "</div>\n";
print "</td></tr>\n";
print "  <tr>\n";
print "   <td colspan=\"5\">&nbsp;</td>\n";
print "  </tr>\n";
print "</table>\n";
print "<p>&nbsp;</p>\n";
?>
