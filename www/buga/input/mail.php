<?php
Class Input_mail Extends Input_Base {
	function index()
	{
		$this->registry['output']->__set('submenu', 'mail');
		$this->registry['output']->__show('/mail/index');
	}

	function add()
	{
		if(!isset($_SESSION['errorMessage']))
		{
			$message = "Add Email account";
		}
		else
		{
			$message = $_SESSION['errorMessage'];
			unset($_SESSION['errorMessage']);
		}
		$this->registry['output']->__set('message', $message);
		$this->registry['output']->__set('submenu', 'mail');
		$this->registry['output']->__show('/mail/add');
		if(isset($_POST['btn']))
		{
			$array = array('type' 			=> 'add',
							'class'			=> 'email',
								'task' 			=> array(	'otherfields' => 0,
															'empty' => 1,
															'trim' => 1,
															'nontrim' => 0,
															'validate' => 1,
															'md5' => 1,
															'match'	=> 0),
								'otherfields' 	=> '',
								'empty'			=> 'txtEmail|txtEmailpass|txtDomain',
								'trim' 			=> 'txtEmail|txtEmailpass|txtDomain',
								'nontrim' 		=> '',
								'validate' 		=> array(	0 => 'txtEmail|LandN|Please enter Email username in correct format'),
		                        'md5'			=> 'txtEmailpass');
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
			echo "<script>document.location='" . WEB_ROOT . "buga/mail/'</script>";
		}

		if(!isset($_SESSION['errorMessage']))
		{
			$message = "Modify Email User";
		}
		else
		{
			$message = $_SESSION['errorMessage'];
			unset($_SESSION['errorMessage']);
		}

        $sql = "SELECT * FROM tbl_email WHERE email_id = '" . $id . "' AND user_id = '" . $_SESSION['number'] . "'";
		$stmt = $this->registry['conn']->query($sql);
		$result = $stmt->fetch(PDO::FETCH_OBJ);
		$user_id2=$result->user_id;
		$domain_id2=$result->domain_id;
		$_POST['c_email_name']=$email_name2=$result->email_name;
		$_POST['c_email_id']=$result->email_id;

		$sql = "SELECT * FROM tbl_domain WHERE domain_id = '" . $domain_id2 . "' AND user_id = '" . $_SESSION['number'] . "'";
		$stmt = $this->registry['conn']->query($sql);
		$result = $stmt->fetch(PDO::FETCH_OBJ);
		$domain_name = $result->domain_name;

		$this->registry['output']->__set('domain_id', $domain_id2);
		$this->registry['output']->__set('domain_name', $domain_name);

		$this->registry['output']->__set('user_id2', $user_id2);
		$this->registry['output']->__set('domain_id2', $domain_id2);
		$this->registry['output']->__set('email_username2', $email_name2);
		$this->registry['output']->__set('message', $message);
		$this->registry['output']->__set('submenu', 'mail');
		$this->registry['output']->__show('/mail/modify');
		if(isset($_POST['btn']))
		{
					$array = array(
							'type' 			=> 'modify',
							'class'			=> 'email',
							'task' 		=> array(	'otherfields' => 1,
														'empty' => 1,
														'trim' => 1,
														'nontrim' => 0,
														'validate' => 1,
														'md5' => 1,
														'match'			=> 1),
							'otherfields' 	=> 'c_email_name|c_email_id',
							'empty'			=> 'txtEmail|txtEmailpass|txtDomain',
							'trim' 			=> 'txtEmail|txtEmailpass|txtDomain',
							'nontrim' 		=> '',
							'validate' 		=> array(	0 => 'txtEmail|LandN|Please enter Email username in correct format'),
		                    'md5'			=> 'txtEmailpass');
			new process($this->registry, $array);
		}
	}

	function search()
	{
		$this->registry['output']->__set('submenu', 'mail');
		$this->registry['output']->__show('/mail/search');
	}

	function result()
	{
		$this->registry['output']->__set('submenu', 'mail');
		$this->registry['output']->__show('/mail/result');
	}
}