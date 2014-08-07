<?php
print "<div align=centre>";
$todayday = date(d);
$todaymonth = date(m);
$todayyear = date(Y);
$date = $todayyear . '-' . $todaymonth . '-' . $todayday;

        $sql = "SELECT * FROM tbl_subscribe WHERE user_id = '" . $_SESSION['number'] . "'";
		$stmt = $this->registry['conn']->query($sql);
		$result = $stmt->fetch(PDO::FETCH_OBJ);
		$sub_end = $result->sub_date;
if($date == $sub_end)
{	print "Dates are matched";
}else{	print "Your subscription ends at " . $sub_end;
}
print "</div>";
?>