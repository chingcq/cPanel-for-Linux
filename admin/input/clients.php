<?php
Class Input_clients Extends Input_Base {
	function index()
	{
		$this->registry['output']->__set('submenu', 'clients');
		$this->registry['output']->__show('/clients/index');

	}

	function add()
	{
		if(!isset($_SESSION['errorMessage']))
		{
			$message = "Add User";
		}
		else
		{
			$message = $_SESSION['errorMessage'];
			unset($_SESSION['errorMessage']);
		}
				if(isset($_POST['btn']))
		{
			if($_POST['txtpass']==$_POST['txtrepass'])
			{
				$array = array('type' 			=> 'add',
								'class'			=> 'client',
									'task' 			=> array(	'otherfields' => 0,
																'empty' => 1,
																'trim' => 1,
																'nontrim' => 0,
																'validate' => 1,
																'md5' => 0,
																'match'	=> 1),
									'otherfields' 	=> '',
									'empty'			=> 'txtusername|txtpass|txtrepass',
									'trim' 			=> 'txtusername|txtpass|txtrepass',
									'nontrim' 		=> '',
									'validate' 		=> array(	0 => 'txtusername|LandN|Please enter username in correct format'));
				new process($this->registry, $array);
			}
			else
			{
				$_SESSION['errorMessage'] = "Passwords don't match";
			}
		}
		$this->registry['output']->__set('message', $message);
		$this->registry['output']->__set('submenu', 'clients');
		$this->registry['output']->__show('/clients/add');
	}

	function detail()
	{
		$action = isset($_GET['id']) ? $_GET['id'] : '';
		$sql = "SELECT * FROM buga WHERE user_id = '" . $action . "'";
		$sql_1 = "SELECT * FROM tbl_userinfo WHERE user_id = '" . $action . "'";
		$sql_2 = "SELECT * FROM tbl_subscribe WHERE user_id = '" . $action . "'";
		$sql_3 = "SELECT * FROM domains WHERE user_id = '" . $action . "'";
		$sql_4 = "SELECT * FROM users WHERE user_id = '" . $action . "'";
		$sql_5 = "SELECT * FROM ftpd WHERE user_id = '" . $action . "'";

		$stmt = $this->registry['conn']->query($sql);
		$result = $stmt->fetch(PDO::FETCH_OBJ);
		$this->registry['output']->__set('user_login', $result->user_login);

		$stmt = $this->registry['conn']->query($sql_1);
		$result = $stmt->fetch(PDO::FETCH_OBJ);
		$this->registry['output']->__set('user_name', $result->user_name);
		$this->registry['output']->__set('user_surname', $result->user_surname);
		$this->registry['output']->__set('user_company', $result->user_company);
		$this->registry['output']->__set('user_email', $result->user_email);
		$this->registry['output']->__set('user_address1', $result->user_address1);
		$this->registry['output']->__set('user_address2', $result->user_address2);
		$this->registry['output']->__set('user_city', $result->user_city);
		$this->registry['output']->__set('user_country', $result->user_country);
		$this->registry['output']->__set('user_postcode', $result->user_postcode);
		$this->registry['output']->__set('user_telephone', $result->user_telephone);
		$this->registry['output']->__set('user_memo', $result->user_memo);
		$this->registry['output']->__set('user_gender', $result->user_gender);
		$user_aged = $result->user_aged;
		$user_agem = $result->user_agem;
		$user_agey = $result->user_agey;
		$this->registry['output']->__set('user_age', $user_aged . "/" . $user_agem . "/" . $user_agey);
		$this->registry['output']->__set('user_regdate', $result->user_regdate);

		$stmt = $this->registry['conn']->query($sql_2);
		$result = $stmt->fetch(PDO::FETCH_OBJ);
		$this->registry['output']->__set('sub_date', $result->sub_date);

		$result = $this->registry['conn']->query($sql_3);
        $count = $result->rowCount();
		$this->registry['output']->__set('domain', $count);

		$result = $this->registry['conn']->query($sql_4);
        $count = $result->rowCount();
		$this->registry['output']->__set('email', $count);

		$result = $this->registry['conn']->query($sql_5);
        $count = $result->rowCount();
		$this->registry['output']->__set('ftp', $count);


		$this->registry['output']->__set('submenu', 'clients');
		$this->registry['output']->__show('/clients/detail');
	}

	function modify()
	{
		if(isset($_POST['btn']))
		{
			$array = array('type' 			=> 'modify',
							'class'			=> 'client',
								'task' 			=> array(	'otherfields' => 1,
															'empty' => 0,
															'trim' => 0,
															'nontrim' => 0,
															'md5' => 0,
															'match'	=> 0),
								'otherfields' 	=> 'user_info_id|user_name|user_surname|user_company|user_email|user_address1|user_address2|user_city|Country|user_postcode|user_telephone|user_gender|user_aged|user_agem|user_agey|mtxDescription',
								'empty'			=> '',
								'trim' 			=> '',
								'nontrim' 		=> '');
			new process($this->registry, $array);
		}
		$action = isset($_GET['id']) ? $_GET['id'] : '';
		$this->registry['output']->__set('action', $action);
		$sql = "SELECT * FROM buga WHERE user_id = '" . $action . "'";
		$sql_1 = "SELECT * FROM tbl_userinfo WHERE user_id = '" . $action . "'";

		$stmt = $this->registry['conn']->query($sql);
		$result = $stmt->fetch(PDO::FETCH_OBJ);
		$this->registry['output']->__set('user_login', $result->user_login);

		$stmt = $this->registry['conn']->query($sql_1);
		$result = $stmt->fetch(PDO::FETCH_OBJ);
		$_POST['user_info_id'] = $action; print $action;
		$this->registry['output']->__set('user_name', $result->user_name);
		$this->registry['output']->__set('user_surname', $result->user_surname);
		$this->registry['output']->__set('user_company', $result->user_company);
		$this->registry['output']->__set('user_email', $result->user_email);
		$this->registry['output']->__set('user_address1', $result->user_address1);
		$this->registry['output']->__set('user_address2', $result->user_address2);
		$this->registry['output']->__set('user_city', $result->user_city);
		$this->registry['output']->__set('user_country', $result->user_country);
		$this->registry['output']->__set('user_postcode', $result->user_postcode);
		$this->registry['output']->__set('user_telephone', $result->user_telephone);
		$this->registry['output']->__set('user_memo', $result->user_memo);
		$this->registry['output']->__set('user_gender', $result->user_gender);
		$user_aged = $result->user_aged;
		$user_agem = $result->user_agem;
		$user_agey = $result->user_agey;
		$this->registry['output']->__set('user_aged', $user_aged);
		$this->registry['output']->__set('user_agem', $user_agem);
		$this->registry['output']->__set('user_agey', $user_agey);
		$this->registry['output']->__set('submenu', 'clients');
		$this->registry['output']->__show('/clients/modify');
	}

	function search()
	{
		$this->registry['output']->__set('submenu', 'clients');
		$this->registry['output']->__show('/clients/search');
	}

	function result()
	{
		$this->registry['output']->__set('submenu', 'clients');
		$this->registry['output']->__show('/clients/result');
	}
}
?>
