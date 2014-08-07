<?
print "<form action=\"/buga/mail/result/\" method=\"post\" name=\"frm\" id=\"frm\">\n";
print "<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"1\" class=\"text\">\n";
print "<tr align=\"left\" id=\"listTableHeader\"> <td></td>\n";
print "<td><b>Search</b></td> \n";
print "</tr> \n";
print "<tr class=row1>\n";
print "<td width=150 class=\"label\">Email</td>\n";
print "<td class=\"content\"><input name=\"txtEmail\" type=\"text\" class=\"box\" id=\"txtEmail\" size=\"50\" maxlength=\"255\"></td>\n";
print "</tr>\n";
print "<tr class=row1>\n";
print "<td width=150 class=\"label\">Domain ID</td>\n";
print "<td class=\"content\">";
print "<select name=\"txtDomain\"> \n";
		$sql = "SELECT * FROM tbl_domain WHERE user_id = '" . $_SESSION['number'] . "'";
		$result = $this->registry['conn']->query($sql);
		$numrows = $result->rowCount();
		if ($numrows > 0)
		{
			$i = 0;
			foreach ($this->registry['conn']->query($sql) as $row)
			{
				print "<option value='" . $row['domain_id'] . "'>" . $row['domain_name'] . "</option> \n";
			}
		}
print "</select> \n";
print "</td>\n";
print "</tr>\n";
print "</table>\n";
print "<div align=center></p><input name=\"btn\" type=\"submit\" id=\"btn\" value=\"Search\" class=\"box\"></div>\n";
print "</form>\n";
?>