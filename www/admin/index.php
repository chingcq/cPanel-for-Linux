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

$output = new output($registry);
$registry->__set('output', $output);

$router = new router($registry);
$registry->__set('router', $router);

$router->setPath(SRV_ROOT . 'input');
$router->start();
?>