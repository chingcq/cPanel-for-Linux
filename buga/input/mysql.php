<?php
Class Input_mysql Extends Input_Base {
	function index()
	{

		$this->registry['output']->__set('submenu', 'mysql');
		$this->registry['output']->__show('/mysql/index');

	}

	function add()
	{
	if(!isset($_SESSION['errorMessage']))
		{
			$message = "Add MySQL";
		}
		else
		{
			$message = $_SESSION['errorMessage'];
			unset($_SESSION['errorMessage']);
		}
		$this->registry['output']->__set('message', $message);
		$this->registry['output']->__set('submenu', 'mysql');
		$this->registry['output']->__show('/mysql/add');
		$_POST['txtmysql'] = "" . $_SESSION['number'] . "_" . $_POST['txtmysql'] . "";
		if(isset($_POST['btn']))
		{

			$array = array('type' 			=> 'add',
						   'class'			=> 'mysql',
								'task' 			=> array(	'otherfields' => 0,
															'empty' => 1,
															'trim' => 1,
															'nontrim' => 0,
															'validate' => 1,
															'md5' => 0,
															'match'	=> 1),
								'otherfields' 	=> '',
								'empty'			=> 'txtmysql|txtDomain',
								'trim' 			=> 'txtmysql|txtDomain',
								'nontrim' 		=> '',
								'validate' 		=> array(	0 => 'txtmysql|LandN|Please enter mysql db name in correct format'));
			new process($this->registry, $array);
		}

	}

	function modify()
	{
		if (isset($_GET['id']) && $_GET['id'] > 0)
		{
			$id = $_GET['id'];
		}
		else
		{
			echo "<script>document.location='" . WEB_ROOT . "buga/mysql/'</script>";
		}

		if(!isset($_SESSION['errorMessage']))
		{
			$message = "Modify MySQL";
		}
		else
		{
			$message = $_SESSION['errorMessage'];
			unset($_SESSION['errorMessage']);
		}

        $sql = "SELECT * FROM tbl_mysql WHERE mysql_id = '" . $id . "' AND user_id = '" . $_SESSION['number'] . "'";
		$stmt = $this->registry['conn']->query($sql);
		$result = $stmt->fetch(PDO::FETCH_OBJ);
		$user_id2=$result->user_id;
		$domain_id2=$result->domain_id;
		$_POST['c_mysql_db']=$ftp_username2=$result->mysql_dbname;
		$_POST['c_mysql_id']=$result->mysql_id;
		$ftp_username2 = explode("_", $ftp_username2);
		$ftp_username2 = $ftp_username2[1];

		$sql = "SELECT * FROM tbl_domain WHERE domain_id = '" . $domain_id2 . "' AND user_id = '" . $_SESSION['number'] . "'";
		$stmt = $this->registry['conn']->query($sql);
		$result = $stmt->fetch(PDO::FETCH_OBJ);
		$domain_name = $result->domain_name;

		$this->registry['output']->__set('domain_id', $domain_id2);
		$this->registry['output']->__set('domain_name', $domain_name);
		$this->registry['output']->__set('user_id2', $user_id2);
		$this->registry['output']->__set('domain_id2', $domain_id2);
		$this->registry['output']->__set('ftp_username2', $ftp_username2);
		$this->registry['output']->__set('message', $message);
		$this->registry['output']->__set('submenu', 'mysql');
		$this->registry['output']->__show('/mysql/modify');
		if(isset($_POST['btn']))
		{
			$_POST['txtmysql'] = "" . $_SESSION['number'] . "_" . $_POST['txtmysql'] . "";
					$array = array('type' 			=> 'modify',
							'class'			=> 'mysql',
							'task' 		=> array(	'otherfields' => 1,
														'empty' => 1,
														'trim' => 1,
														'nontrim' => 0,
														'validate' => 1,
														'md5' => 1,
														'match'			=> 1),
							'otherfields' 	=> 'c_mysql_db|c_mysql_id',
							'empty'			=> 'txtmysql|txtDomain',
							'trim' 			=> 'txtmysql|txtDomain',
							'nontrim' 		=> '',
							'validate' 		=> array(	0 => 'txtmysql|LandN|Please enter mysql db name in correct format'));
			new process($this->registry, $array);
		}

	}

	function search()
	{
		$this->registry['output']->__set('submenu', 'mysql');
		$this->registry['output']->__show('/mysql/search');
	}

	function result()
	{
		$this->registry['output']->__set('submenu', 'mysql');
		$this->registry['output']->__show('/mysql/result');
	}
}