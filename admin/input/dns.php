<?php
Class Input_dns Extends Input_Base {
	function index()
	{
		if (isset($_GET['domain']) && (int)$_GET['domain'] > 0) {
		    $Id = (int)$_GET['domain'];
		    $_SESSION['dns'] = $Id;
		    header('Location: ' . WEB_ROOT . 'admin/dns/detail/');
		}
		elseif($_SESSION['dns'])
		{
			header('Location: ' . WEB_ROOT . 'admin/dns/detail/');
		}
		else
		{			if(isset($_POST['btn']))
			{				$_SESSION['dns'] = $_POST['name'];
				header('Location: ' . WEB_ROOT . 'admin/dns/detail/&domain=' . $_POST['name'] . '');
			}
			$this->registry['output']->__set('submenu', 'domain');
			$this->registry['output']->__show('/dns/index');
		}
	}

	function add()
	{
		if(!isset($_SESSION['errorMessage']))
		{
			$message = "Add DNS User";
		}
		else
		{
			$message = $_SESSION['errorMessage'];
			unset($_SESSION['errorMessage']);
		}
		$this->registry['output']->__set('message', $message);
		$this->registry['output']->__set('submenu', 'domain');
		$this->registry['output']->__show('/dns/add');

		if(isset($_POST['btn']))
		{
			$sql = "SELECT * FROM domains WHERE id = '" . $_SESSION['dns'] . "'";
			$stmt = $this->registry['conn']->query($sql);
			$result = $stmt->fetch(PDO::FETCH_OBJ);
			$domain_name = $result->name;
			$user_id = $result->user_id;

			$_POST['domain_name'] = $domain_name;
			$_POST['user_id'] = $user_id;
			$_POST['dns_name'] = $domain_name;
			$array = array('type' 			=> 'add',
							'class'			=> 'dns',
								'task' 			=> array(	'otherfields' => 1,
															'empty' => 1,
															'trim' => 1,
															'nontrim' => 0,
															'validate' => 1,
															'md5' => 0,
															'match'	=> 0),
								'otherfields' 	=> 'user_id|domain_name|dns_name',
								'empty'			=> 'name|type|content',
								'trim' 			=> 'name|type|content',
								'nontrim' 		=> '',);
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
			echo "<script>document.location='" . WEB_ROOT . "admin/dns/'</script>";
		}

		if(!isset($_SESSION['errorMessage']))
		{
			$message = "Modify DNS Record";
		}
		else
		{
			$message = $_SESSION['errorMessage'];
			unset($_SESSION['errorMessage']);
		}

        	$sql = "SELECT * FROM records WHERE id = '" . $id . "'";
		$stmt = $this->registry['conn']->query($sql);
		$result = $stmt->fetch(PDO::FETCH_OBJ);
		$type=$result->type;
		$record=$result->name;
		$content=$result->content;

		$this->registry['output']->__set('type', $type);
		$this->registry['output']->__set('name', $record);
		$this->registry['output']->__set('message', $message);
		$this->registry['output']->__set('content', $content);

		$_POST['c_id']=$id;
		$this->registry['output']->__set('submenu', 'domain');
		$this->registry['output']->__show('/dns/modify');
		if(isset($_POST['btn']))
		{
					$array = array('type' 			=> 'modify',
							'class'			=> 'dns',
							'task' 		=> array(	'otherfields' => 1,
														'empty' => 1,
														'trim' => 1,
														'nontrim' => 0,
														'validate' => 0,
														'md5' => 1,
														'match'			=> 0),
							'otherfields'	=> 'c_id',
							'empty'			=> 'type|name|content',
							'trim' 			=> 'type|name|content',
							'nontrim' 		=> '',);
			new process($this->registry, $array);
		}

	}



	function detail()
	{
		$this->registry['output']->__set('submenu', 'domain');
		$this->registry['output']->__show('/dns/detail');
	}
}
