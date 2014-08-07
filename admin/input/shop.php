<?php
Class Input_shop Extends Input_Base {
	function index()
	{
		$this->registry['output']->__set('submenu', 'shop');
		$this->registry['output']->__show('/shop/index');		
	}

	function search()
	{
		$this->registry['output']->__set('submenu', 'shop');
		$this->registry['output']->__show('/shop/search');		
	}

	function set()
	{
		$sql = "SELECT * FROM tbl_shop_config";
		$stmt = $this->registry['conn']->query($sql);
		$result = $stmt->fetch(PDO::FETCH_OBJ);
		$this->registry['output']->__set('price', $result->shop_price);
		$this->registry['output']->__set('submenu', 'shop');
		$this->registry['output']->__show('/shop/add');	
		if(isset($_POST['btn']))
		{
			$query = "UPDATE tbl_shop_config SET shop_price ='" . $_POST['txtPrice'] . "'";
			$this->registry['conn']->query($query);	
			echo "<script>document.location='" . $_SERVER['REQUEST_URI'] . "'</script>";
			
		}
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
		
		$this->registry['output']->__set('submenu', 'shop');
		$this->registry['output']->__show('/shop/detail');
	}
	
	function result()
	{
		$this->registry['output']->__set('submenu', 'shop');
		$this->registry['output']->__show('/shop/result');		
	}
}
