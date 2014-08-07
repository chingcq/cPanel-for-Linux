<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
#error_reporting (E_STRICT);
#error_reporting (0);
session_start();
/**
 * Getting location
 * $thisFile modify FILE link str_replace replaces all \ to /.
 * $srvRoot replaces "library/config.php" to a blank space to get link to root location.
 * then i define location as "SRV_ROOT".
 * docRoot contains server_name which is basicly address. without 'http://'
 * then i write server_name in "standard" way that url is writen 
 */
$thisFile = str_replace('\\', '/', __FILE__);
$srvRoot  = str_replace('library/config.php', '', $thisFile);

$docRoot = $_SERVER['SERVER_NAME'];
$docRoot = 'http://' .  $docRoot . '/';

define('SRV_ROOT', $srvRoot);
define('WEB_ROOT', $docRoot);

/**
 * Running all core files
 */
include SRV_ROOT . '/core/input_base.class.php';
include SRV_ROOT . '/core/registry.class.php';
include SRV_ROOT . '/core/router.class.php';
include SRV_ROOT . '/core/output.class.php';
include SRV_ROOT . '/core/errorlogger.class.php';

/**
 * For loading classes - starts up automaticaly, function needs variable to work with.
 * var $class is made all lower letters and added file extantion to the end.
 * Setting path to the file. $file in basename, for security reasons.
 * If file doesn't exists we will return error message on the screen.
 * Then we include that file in memory
 */
function __autoload($class) {
    $file = strtolower($class) . '.class.php';
    $file = SRV_ROOT . 'process/' . basename($file);

    if (!file_exists($file)) {
        return false;
    }

    include ($file);
}

/**
 * Loading registry class
 * started here because will be used in different part of script which will not be runned under index file
 */
$registry = new Registry;

$conn = new PDO('mysql:host=localhost;dbname=hosting', 'root', '');
$registry->__set('conn', $conn);
?>
