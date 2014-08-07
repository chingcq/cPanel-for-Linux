<?php
class user_watch
{
	protected $registry;
    private $sql;

	public function __construct($registry)
	{
		$this->registry = $registry;
		if(!isset($_SESSION['watcher']))
		{
			user_watch::set_log();
		}
		user_watch::log_page();
	}

	private function set_log()
	{
	    if(!isset($_SERVER['HTTP_REFERER'])){
        	$ref = 'none';
        }else{
        	$ref = $_SERVER['HTTP_REFERER'];
        }		$this->sql = "INSERT INTO log_user (`log_ip`, `log_referer`, `log_browser`) VALUES('" . $_SERVER['REMOTE_ADDR'] . "', '" . $ref . "', '" . $_SERVER['HTTP_USER_AGENT'] . "')";
		$this->registry['conn']->exec($this->sql);
		$_SESSION['watcher']= $_SERVER['REMOTE_ADDR'];
	}

	private function log_page()
	{		$this->sql = "INSERT INTO log_pages (`page_name`, `page_date`, `log_ip`) VALUES('" . $_SERVER['REQUEST_URI'] . "', NOW(), '" . $_SESSION['watcher'] . "')";
		$this->registry['conn']->exec($this->sql);
	}
}