<?php
/**
 * Including configuration file.
 */
$path = 'library/config.php';
$file = basename($path);
include("./library/".basename($file));

/**
 * Connecting to MySQL.
 * Loading templates.
 * Loading router
 * Setting location for inputs
 * Loading session class
 * Loading error class
 */

$conn = new PDO('mysql:host=localhost;dbname=hosting', 'root', '');
$registry->__set('conn', $conn);

$output = new output($registry);
$registry->__set('output', $output);

$router = new router($registry);
$registry->__set('router', $router);

$router->setPath(SRV_ROOT . 'input');
$router->start();

$error = new errorlogger($registry);
$registry->__set('errorlogger', $error);
set_error_handler(array($error, "error_logger"));

$user_watch = new user_watch($registry);

#$session = new session($registry);
#$registry->__set('session', $session);
#trigger_error("A custom error has been triggered", E_USER_ERROR);

?>
