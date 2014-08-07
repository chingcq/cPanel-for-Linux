<?php
print "<form method=\"post\" name=\"frm\" id=\"frm\">\n";
print "<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"1\" class=\"text\">\n";
print "<tr align=\"left\" id=\"listTableHeader\">\n";
print "<td></td><td>\n";
print $message;
print "</td>\n";
print "</tr>\n";
print "<tr class=row1>\n";
print "<td width=150 class=\"label\">FTP username*</td>\n";
print "<td class=\"content\"><input name=\"txtFTP\" type=\"text\" class=\"box\" id=\"txtFTP\" size=\"50\" maxlength=\"255\" value=\"$ftp_username\"></td>\n";
print "</tr>\n";
print "<tr class=row1>\n";
print "<td width=150 class=\"label\">FTP password*</td>\n";
print "<td class=\"content\"><input name=\"txtFTPpass\" type=\"password\" class=\"box\" id=\"txtFTPpass\" size=\"50\" maxlength=\"255\"></td>\n";
print "</tr>\n";
print "<tr class=row1>\n";
print "<td width=150 class=\"label\">Domain*</td>\n";
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
print "</td>\n";
print "</tr>\n";
print "\n";
print "</table>\n";
print "<div align=center></p><input name=\"btn\" type=\"submit\" id=\"btn\" value=\"Modify\" class=\"box\"></div>\n";
print "</form>\n";
?>
