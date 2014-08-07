<?php
/**
 * Logs info
 * To use e.g. $user_watch = new user_watch($registry);
 * alse will be done by __construct
 */
class user_watch
{
	protected $registry;
	/**
	 * function __construct does every thing.
	 * firsly setting connection with registry.
	 * then starting checking session['watcher']
	 * if it doesn't exists then we create one in set_log() function
	 * other ways log data using log_page()
	 */
	public function __construct($registry)
	{
		$this->registry = $registry;
		if(!isset($_SESSION['watcher']))
		{
			user_watch::set_log();
		}
		user_watch::log_page();
	}
	/**
	 * Logs data on user to database and to session['watcher']
	 * firstly we find out to refered that user
	 * after creating sql query in $sql.
	 * and executing it.
	 * and setting session['watcher']
	 */
	private function set_log()
	{
	    if(!isset($_SERVER['HTTP_REFERER'])){
        	$ref = 'none';
        }
        else
        {
        	$ref = $_SERVER['HTTP_REFERER'];
        }
     	$browser = $_SERVER['HTTP_USER_AGENT'];
		if(preg_match("/MSIE/i", $browser)){
			$browser = "Internet Explorer";
		}elseif(preg_match("/Chrome/i", $browser)){
			$browser = "Chrome";
		}elseif(preg_match("/Firefox/i", $browser)){			$browser = "Firefox";
		}elseif(preg_match("/Opera/i", $browser)){
			$browser = "Opera";
		}
		else
		{			$browser = "Other";
		}

		$sql = "INSERT INTO log_user (`log_ip`, `log_referer`, `log_browser`) VALUES('" . $_SERVER['REMOTE_ADDR'] . "', '" . $ref . "', '" . $browser . "')";
		$this->registry['conn']->exec($sql);
		$_SESSION['watcher']= $_SERVER['REMOTE_ADDR'];
	}
	/**
	 * logs page where user is
	 * var $sql stores sql query which is executed on next line
	 */
	private function log_page()
	{
		$sql = "INSERT INTO log_pages (page_name, page_date, log_ip) VALUES('" . $_SERVER['REQUEST_URI'] . "', NOW(), '" . $_SESSION['watcher'] . "')";
		$this->registry['conn']->exec($sql);
	}
}