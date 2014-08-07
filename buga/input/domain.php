<?php
Class Input_Domain Extends Input_Base {
	function index()
	{
		$this->registry['output']->__set('submenu', 'domain');
		$this->registry['output']->__show('/domain/index');
	}

	function add()
	{
	if(!isset($_SESSION['errorMessage']))
		{
			$message = "Add Domain";
		}
		else
		{
			$message = $_SESSION['errorMessage'];
			unset($_SESSION['errorMessage']);
		}
		$this->registry['output']->__set('message', $message);
		$this->registry['output']->__set('submenu', 'domain');
		$this->registry['output']->__show('/domain/add');
		if(isset($_POST['btn']))
		{
			$array = array('type' 			=> 'add',
							'class'			=> 'domain',
								'task' 			=> array(	'otherfields' => 0,
															'empty' => 1,
															'trim' => 1,
															'nontrim' => 0,
															'validate' => 1,
															'md5' => 0,
															'match'	=> 1),
								'otherfields' 	=> '',
								'empty'			=> 'txtDomain',
								'trim' 			=> 'txtDomain',
								'nontrim' 		=> '',
								'validate' 		=> array(	0 => 'txtDomain|domain|Please enter domain in correct format'));
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
			echo "<script>document.location='" . WEB_ROOT . "admin/domain/'</script>";
		}

		if(!isset($_SESSION['errorMessage']))
		{
			$message = "Modify Domain";
		}
		else
		{
			$message = $_SESSION['errorMessage'];
			unset($_SESSION['errorMessage']);
		}

        $sql = "SELECT * FROM tbl_domain WHERE domain_id = '" . $id . "' AND user_id = '" . $_SESSION['number'] . "'";
		$stmt = $this->registry['conn']->query($sql);
		$result = $stmt->fetch(PDO::FETCH_OBJ);
		$user_id2=$result->user_id;
		$domain_id2=$result->domain_name;
		$_POST['c_domain']=$domain_id2;
		$_POST['c_id']=$id;

		$this->registry['output']->__set('domain_id2', $domain_id2);
		$this->registry['output']->__set('message', $message);
		$this->registry['output']->__set('submenu', 'domain');
		$this->registry['output']->__show('/domain/modify');
		if(isset($_POST['btn']))
		{
					$array = array(
							'type' 			=> 'modify',
							'class'			=> 'domain',
							'task' 		=> array(	'otherfields' => 1,
														'empty' => 1,
														'trim' => 1,
														'nontrim' => 0,
														'validate' => 1,
														'md5' => 1,
														'match'			=> 1),
							'otherfields' 	=> 'c_domain|c_id',
							'empty'			=> 'txtDomain',
							'trim' 			=> 'txtDomain',
							'nontrim' 		=> '',
							'validate' 		=> array(	0 => 'txtDomain|domain|Please enter domain in correct format'));
			new process($this->registry, $array);
		}
	}

	function search()
	{
		$this->registry['output']->__set('submenu', 'domain');
		$this->registry['output']->__show('/domain/search');
	}

	function result()
	{
		$this->registry['output']->__set('submenu', 'domain');
		$this->registry['output']->__show('/domain/result');
	}
}