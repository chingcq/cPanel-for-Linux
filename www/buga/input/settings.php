<?php
Class Input_settings Extends Input_Base {
	function index()
	{
		if(isset($_POST['btn']))
		{
			$_SESSION['length'] = $_POST['Month'];
			header('Location: ' . WEB_ROOT . 'buga/settings/confirm');
		}
		$action = $_SESSION['number'];
		$sql = "SELECT * FROM tbl_subscribe WHERE user_id = '" . $action . "'";

		$stmt = $this->registry['conn']->query($sql);
		$result = $stmt->fetch(PDO::FETCH_OBJ);
		$contractuntil = $result->sub_date;

		$numrows = $stmt->rowCount();
		$this->registry['output']->__set('contractuntil', $contractuntil);
		$this->registry['output']->__set('submenu', 'settings');
		$this->registry['output']->__show('/settings/index');
	}

	function confirm()
	{
		if($_SESSION['length'] > 12)
		{
			header('Location: ' . WEB_ROOT . 'buga/settings/');
		}
		elseif($_SESSION['length'] < 1)
		{
			header('Location: ' . WEB_ROOT . 'buga/settings/');
		}
		$action = $_SESSION['number'];
		$sql = "SELECT * FROM tbl_shop_config";

		$stmt = $this->registry['conn']->query($sql);
		$result = $stmt->fetch(PDO::FETCH_OBJ);
		$shop_price = $result->shop_price;
		$subTotal =  $shop_price * $_SESSION['length'];
		$total = ($subTotal * 0.175) + $subTotal;

		$this->registry['output']->__set('total', $total);
		$this->registry['output']->__set('subTotal', $subTotal);
        $this->registry['output']->__set('length', $_SESSION['length']);
		$this->registry['output']->__set('shop_price', $shop_price);
		$this->registry['output']->__set('submenu', 'settings');
		$this->registry['output']->__show('/settings/confirm');
        if(isset($_POST['btn']))
		{
			$_SESSION['orderAmount'] = $total;
		   #$_SESSION['length'];
		   	require_once "" . SRV_ROOT . "include/paypal/payment.php";
		}

	}

	function pass()
	{
	    if(isset($_POST['btn']))
		{
			if($_POST['txtpass']==$_POST['txtrepass'])
			{
				$action = $_SESSION['number'];
				$this->registry['output']->__set('action', $action);
				$sql = "SELECT * FROM buga WHERE user_id = '" . $action . "'";

				$stmt = $this->registry['conn']->query($sql);
				$result = $stmt->fetch(PDO::FETCH_OBJ);
				$login = $result->user_login;

                $pass = $_POST['txtpass'] . '' . $login;
                $_POST['txtpass'] = $pass;

				$array = array('type' 			=> 'modify',
								'class'			=> 'pass-mod',
									'task' 			=> array(	'otherfields' => 1,
																'empty' => 0,
																'trim' => 0,
																'nontrim' => 0,
																'validate' => 0,
																'md5' => 1,
																'match'	=> 0),
									'otherfields' 	=> 'txtpass',
									'md5' => 'txtpass');
				new process($this->registry, $array);
			}
			else
			{
				$_SESSION['errorMessage'] = "Passwords don't match";
			}
		}
		$this->registry['output']->__set('submenu', 'settings');
		$this->registry['output']->__show('/settings/add');
	}

	function change()
	{		if(isset($_POST['btn']))
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
		$action = $_SESSION['number'];
		$sql = "SELECT * FROM buga WHERE user_id = '" . $action . "'";
		$sql_1 = "SELECT * FROM tbl_userinfo WHERE user_id = '" . $action . "'";
		$sql_2 = "SELECT * FROM tbl_subscribe WHERE user_id = '" . $action . "'";
		$sql_3 = "SELECT * FROM tbl_domain WHERE user_id = '" . $action . "'";
		$sql_4 = "SELECT * FROM tbl_email WHERE user_id = '" . $action . "'";
		$sql_5 = "SELECT * FROM tbl_ftp WHERE user_id = '" . $action . "'";
		$sql_6 = "SELECT * FROM tbl_mysql WHERE user_id = '" . $action . "'";

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
		$this->registry['output']->__set('user_aged', $user_aged);
		$this->registry['output']->__set('user_agem', $user_agem);
		$this->registry['output']->__set('user_agey', $user_agey);
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

		$result = $this->registry['conn']->query($sql_6);
        $count = $result->rowCount();
		$this->registry['output']->__set('mysql', $count);
		$this->registry['output']->__set('submenu', 'settings');
		$this->registry['output']->__show('/settings/change');
	}
}