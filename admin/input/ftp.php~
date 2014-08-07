<?php
Class Input_FTP Extends Input_Base {
	function index()
	{ 
		$this->registry['output']->__set('submenu', 'ftp');
		$this->registry['output']->__show('/ftp/index');		
	}

	function add()
	{
		if(!isset($_SESSION['errorMessage']))
		{
			$message = "Add FTP User";
		}
		else
		{
			$message = $_SESSION['errorMessage'];
			unset($_SESSION['errorMessage']);
		}
		$this->registry['output']->__set('message', $message);
		$this->registry['output']->__set('submenu', 'ftp');
		$this->registry['output']->__show('/ftp/add');
		if(isset($_POST['btn']))
		{
			$array = array('type' 			=> 'add',
							'class'			=> 'ftp',
								'task' 			=> array(	'otherfields' => 0,
															'empty' => 1,
															'trim' => 1,
															'nontrim' => 0,
															'validate' => 1,
															'md5' => 1,
															'match'	=> 0),
								'otherfields' 	=> '',
								'empty'			=> 'txtFTP|txtFTPpass|txtDomain|txtID',
								'trim' 			=> 'txtFTP|txtFTPpass|txtDomain|txtID',
								'nontrim' 		=> '',
								'validate' 		=> array(	0 => 'txtFTP|LandN|Please enter ftp username in correct format',
															1 => 'txtDomain|onlyNumbers|Only numbers allowed in txtDomain field',
															2 => 'txtID|onlyNumbers|Only numbers allowed in txtID field'),
		                        'md5'			=> 'txtFTPpass');
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
			echo "<script>document.location='" . WEB_ROOT . "admin/ftp/'</script>";
		}

		if(!isset($_SESSION['errorMessage']))
		{
			$message = "Modify FTP User";
		}
		else
		{
			$message = $_SESSION['errorMessage'];
			unset($_SESSION['errorMessage']);
		}

        $sql = "SELECT * FROM tbl_ftp WHERE ftp_id = '" . $id . "'";
		$stmt = $this->registry['conn']->query($sql);
		$result = $stmt->fetch(PDO::FETCH_OBJ);
		$user_id2=$result->user_id;
		$domain_id2=$result->domain_id;
		$_POST['c_ftp_username']=$ftp_username2=$result->ftp_username;
		$_POST['c_ftp_id']=$result->ftp_id;

		$this->registry['output']->__set('user_id2', $user_id2);
		$this->registry['output']->__set('domain_id2', $domain_id2);
		$this->registry['output']->__set('ftp_username2', $ftp_username2);
		$this->registry['output']->__set('message', $message);		$this->registry['output']->__set('submenu', 'ftp');
		$this->registry['output']->__show('/ftp/modify');
		if(isset($_POST['btn']))
		{
					$array = array('type' 			=> 'modify',
							'class'			=> 'ftp',
							'task' 		=> array(	'otherfields' => 1,
														'empty' => 1,
														'trim' => 1,
														'nontrim' => 0,
														'validate' => 1,
														'md5' => 1,
														'match'			=> 1),
							'otherfields' 	=> 'c_ftp_username|c_ftp_id',
							'empty'			=> 'txtFTP|txtFTPpass|txtDomain|txtID',
							'trim' 			=> 'txtFTP|txtFTPpass|txtDomain|txtID',
							'nontrim' 		=> '',
							'validate' 		=> array(	0 => 'txtFTP|LandN|Please enter ftp username in correct format',
														1 => 'txtDomain|onlyNumbers|Only numbers allowed in txtDomain field',
														2 => 'txtID|onlyNumbers|Only numbers allowed in txtID field'),
		                    'md5'			=> 'txtFTPpass');
			new process($this->registry, $array);
		}
	}

	function search()
	{		$this->registry['output']->__set('submenu', 'ftp');
		$this->registry['output']->__show('/ftp/search');
	}

	function result()
	{
		$this->registry['output']->__set('submenu', 'ftp');
		$this->registry['output']->__show('/ftp/result');
	}
}