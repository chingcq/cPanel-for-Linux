<?php
print "<form method=\"post\" name=\"frm\" id=\"frm\">\n";
print "<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"1\" class=\"text\">\n";
print "<tr align=\"left\" id=\"listTableHeader\">\n";
print "<td></td><td>\n";
print $message;
print "</td>\n";
print "</tr>\n";
print "<tr class=row1>\n";
print "<td width=150 class=\"label\">Email username*</td>\n";
print "<td class=\"content\"><input name=\"txtEmail\" type=\"text\" class=\"box\" id=\"txtEmail\" size=\"50\" maxlength=\"255\" value=\"$email_username2\"></td>\n";
print "</tr>\n";
print "<tr class=row1>\n";
print "<td width=150 class=\"label\">Email password*</td>\n";
print "<td class=\"content\"><input name=\"txtEmailpass\" type=\"password\" class=\"box\" id=\"txtEmailpass\" size=\"50\" maxlength=\"255\"></td>\n";
print "</tr>\n";
print "<tr class=row1>\n";
print "<td width=150 class=\"label\">Domain ID*</td>\n";
print "<td class=\"content\">";
print "<select name=\"txtDomain\"> \n";
print "<option value='" . $domain_id . "' selected>" . $domain_name . "</option> \n";
		$sql = "SELECT * FROM domains WHERE user_id = '" . $_SESSION['number'] . "'";
		$result = $this->registry['conn']->query($sql);
		$numrows = $result->rowCount();
		if ($numrows > 0)
		{
			$i = 0;
			foreach ($this->registry['conn']->query($sql) as $row)
			{
				print "<option value='" . $row['id'] . "'>" . $row['name'] . "</option> \n";
			}
		}
print "</select> \n";
print "</td>\n";print "</tr>\n";
print "\n";
print "</table>\n";
print "<div align=center></p><input name=\"btn\" type=\"submit\" id=\"btn\" value=\"Modify\" class=\"box\"></div>\n";
print "</form>\n";
?>
