<?php
/**
 * Including configuration file.
 */
$path = 'config.php';
$file = basename($path);
include("./library/".basename($file));

/**
 * Loading "must have" classes.
 * and $registry some of them if they will be used in other sections/classes
 */
$conn = new PDO('mysql:host=localhost;dbname=hosting', 'root', '');
$registry->__set('conn', $conn);

$error = new errorlogger($registry);
set_error_handler(array($error, "error_logger"));

$auth = new auth($registry);
$auth->checkUser();

$todayday = date(d);
$todaymonth = date(m);
$todayyear = date(Y);
$date = $todayyear . '-' . $todaymonth . '-' . $todayday;

        $sql = "SELECT * FROM tbl_subscribe WHERE user_id = '" . $_SESSION['number'] . "'";
		$stmt = $registry['conn']->query($sql);
		$result = $stmt->fetch(PDO::FETCH_OBJ);
		$sub_end = $result->sub_date;
if($date == $sub_end)
{
	#print "Dates are matched";
}else{
	#print "Your subscription ends at " . $sub_end;
}

$user_watch = new user_watch($registry);

$output = new output($registry);
$registry->__set('output', $output);

$router = new router($registry);
$registry->__set('router', $router);

$router->setPath(SRV_ROOT . 'input');
$router->start();
?>