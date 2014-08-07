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
        }
		$this->registry['conn']->exec($this->sql);
		$_SESSION['watcher']= $_SERVER['REMOTE_ADDR'];
	}

	private function log_page()
	{
		$this->registry['conn']->exec($this->sql);
	}
}