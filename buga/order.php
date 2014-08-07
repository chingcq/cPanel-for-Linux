<?php
		$path = 'library/config.php';
		$file = basename($path);
		include("./library/".basename($file));

		$conn = new PDO('mysql:host=localhost;dbname=hosting', 'root', '');
		$registry->__set('conn', $conn);

		if(isset($_POST['btn']))
		{
			$_SESSION['length'] = $_POST['Month'];
			header('Location: ' . WEB_ROOT . 'confirm.php');
		}
		$action = $_SESSION['number'];
		$sql = "SELECT * FROM tbl_subscribe WHERE user_id = '" . $action . "'";

		$stmt = $registry['conn']->query($sql);
		$result = $stmt->fetch(PDO::FETCH_OBJ);
		$contractuntil = $result->sub_date;

		$numrows = $stmt->rowCount();

print "<table border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"1\" class=\"text\" width=\"800px\" valign=\"top\">\n";
print "<tr align=\"center\" id=\"listTableHeader\" valign=\"top\">\n";
print "<td valign=\"top\">\n";
print "You contract until ";
print $contractuntil;
print "</td></tr>\n";
print "<tr>\n";
print "<form method=\"post\" name=\"frm\" id=\"frm\">\n";
print "<td colspan=\"5\" align=center>Extend your contract by:";
print "<select name=\"Month\"> \n";
print "<option value=\"1\">1</option>\n";
print "<option value=\"2\">2</option>\n";
print "<option value=\"3\">3</option>\n";
print "<option value=\"4\">4</option>\n";
print "<option value=\"5\">5</option>\n";
print "<option value=\"6\">6</option>\n";
print "<option value=\"7\">7</option>\n";
print "<option value=\"8\">8</option>\n";
print "<option value=\"9\">9</option>\n";
print "<option value=\"10\">10</option>\n";
print "<option value=\"11\">11</option>\n";
print "<option value=\"12\">12</option>\n";
print "</select>\n";
print " month<br><br>\n";
print "Pay by :\n";
print "<input name=\"payment\" type=\"radio\" id=\"payment\" value=\"PayPal\" class=\"box\">PayPal<br>\n";
print "<div align=center></p><input name=\"btn\" type=\"submit\" id=\"btn\" value=\"Submit\" class=\"box\"></div>\n";
print "</td>\n";
print "</form>\n";
print "</tr>\n";
print "</table>\n";
print "<p>&nbsp;</p>\n";
?>
