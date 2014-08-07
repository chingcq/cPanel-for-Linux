<?php
Class Input_Index Extends Input_Base
{
	function index()
	{
		$this->registry['output']->__set('message', 'asdads');
		$this->registry['output']->__set('submenu', '');
        $this->registry['output']->__show('/main/index');
  	}

  	function order()
  	{
  			if(isset($_POST['btn']))
		{
			$_SESSION['length'] = $_POST['Month'];
			header('Location: ' . WEB_ROOT . 'confirm');
		}
		$this->registry['output']->__set('submenu', '');
        $this->registry['output']->__show('/main/order');
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

		        if(isset($_POST['btn']))
		{
		   #$_SESSION['length'];
		  	require_once "" . SRV_ROOT . "include/paypal/payment.php";
		}
		$this->registry['output']->__set('submenu', '');
        $this->registry['output']->__show('/main/confirm');
  	}

  	function register()
  	{
		$this->registry['output']->__set('submenu', '');
        $this->registry['output']->__show('/main/register');
  	}
}
?>