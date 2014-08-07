<?php
print "<form method=\"post\" name=\"frmLogin\" id=\"frmLogin\">";
print "<table width=\"550\" border=\"0\"  align=\"center\" cellpadding=\"5\" cellspacing=\"1\" class=\"detailTable\">\n";
print "<div align=center>\n";
print "Confirmation page<br>\n";
print "step 2 out of 3\n";
print "</div>\n";
print "    <tr id=\"infoTableHeader\">\n";
print "        <td colspan=\"3\">Ordered products</td>\n";
print "    </tr>\n";
print "    <tr align=\"center\" class=\"label\">\n";
print "        <td class=content>Products</td>\n";
print "        <td class=content>Price per item</td>\n";
print "        <td class=content>Total</td>\n";
print "    </tr>\n";
print "    <tr class=\"content\">\n";
print "        <td class=content>$length X $shop_price</td>\n";
print "        <td class=content align=\"right\">$shop_price</td>\n";
print "        <td class=content align=\"right\">$subTotal</td>\n";
print "    </tr>\n";
print "	   <tr class=\"content\">\n";
print "        <td colspan=\"2\" align=\"right\">tax</td>\n";
print "        <td align=\"right\">17.5%</td>\n";
print "    </tr>\n";
print "    <tr class=\"content\">\n";
print "        <td colspan=\"2\" align=\"right\">Total</td>\n";
print "        <td align=\"right\">$total</td>\n";
print "    </tr>\n";
print "</table>\n";
print "<div align=center></p><input name=\"btn\" type=\"submit\" id=\"btn\" value=\"Submit\" class=\"box\">
<input name=\"btnBack\" type=\"button\" id=\"btnBack\" value=\"Back\" class=\"box\" onClick=\"window.history.back();\"></div>\n";
print "<p>&nbsp;</p>\n";
?>
