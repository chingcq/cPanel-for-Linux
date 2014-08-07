<?php
Class Input_settings Extends Input_Base {
	function index()
	{
		$this->registry['output']->__set('submenu', 'settings');
		$this->registry['output']->__show('/settings/index');
	}

	function pass()
	{
		if(!isset($_SESSION['errorMessage']))
		{
			$message = "change password";
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
				$sql = "SELECT * FROM klpt";

				$stmt = $this->registry['conn']->query($sql);
				$result = $stmt->fetch(PDO::FETCH_OBJ);
				$login = $result->login;
				$_POST['base'] = $_POST['txtpass'];
                $pass = $_POST['txtpass'] . '' . $login;
                $_POST['txtpass'] = $pass;

				$array = array('type' 			=> 'modify',
								'class'			=> 'pass-mod',
									'task' 			=> array(	'otherfields' => 0,
																'empty' => 1,
																'trim' => 1,
																'nontrim' => 0,
																'validate' => 0,
																'md5' => 1,
																'match'	=> 0),
									'empty' 	=> 'base','txtpass',
									'trim'		=> 'txtpass',
									'md5' => 'txtpass');
				new process($this->registry, $array);
			}
			else
			{
				$_SESSION['errorMessage'] = "Passwords don't match";
			}
		}        $this->registry['output']->__set('message', $message);
		$this->registry['output']->__set('submenu', 'settings');
		$this->registry['output']->__show('/settings/add');
	}

	function dns()
	{
		if(!isset($_SESSION['errorMessage']))
		{
			$message = "Modify DNS";
		}
		else
		{
			$message = $_SESSION['errorMessage'];
			unset($_SESSION['errorMessage']);
		}
		$sql_1 = "SELECT * FROM tbl_settings";
		$stmt = $this->registry['conn']->query($sql_1);
		$result = $stmt->fetch(PDO::FETCH_OBJ);
		$this->registry['output']->__set('dns_refresh', $result->dns_refresh);
		$this->registry['output']->__set('dns_retry', $result->dns_retry);
		$this->registry['output']->__set('dns_expire', $result->dns_expire);
		$this->registry['output']->__set('dns_minimum', $result->dns_minimum);
		$this->registry['output']->__set('dns_ip', $result->dns_ip);

		$this->registry['output']->__set('message', $message);
		$this->registry['output']->__set('submenu', 'settings');
		$this->registry['output']->__show('/settings/dns');
		if(isset($_POST['btn']))
		{
			$array = array('type' 			=> 'modify',
							'class'			=> 'dns-settings',
								'task' 			=> array(	'otherfields' => 0,
															'empty' => 1,
															'trim' => 1,
															'nontrim' => 0,
															'validate' => 1,
															'md5' => 0,
															'match'	=> 0),
								'otherfields' 	=> '',
								'empty'			=> 'dns_refresh|dns_retry|dns_expire|dns_minimum|dns_ip',
								'trim' 			=> 'dns_refresh|dns_retry|dns_expire|dns_minimum|dns_ip',
								'nontrim' 		=> '',
								'validate' 		=> array(	0 => 'dns_refresh|onlyNumbers|Only numbers allowed in Refresh field',
															1 => 'dns_retry|onlyNumbers|Only numbers allowed in Retry field',
															2 => 'dns_expire|onlyNumbers|Only numbers allowed in Expire field',
															3 => 'dns_minimum|onlyNumbers|Only numbers allowed in Minimum field'));
			new process($this->registry, $array);
		}
	}

	function userlog()
	{
		$this->registry['output']->__set('submenu', 'settings');
		$this->registry['output']->__show('/settings/userlog');
	}

	function errorlog()
	{
		$this->registry['output']->__set('submenu', 'settings');
		$this->registry['output']->__show('/settings/errorlog');
	}

	function detail()
	{
	    $action = isset($_GET['ip']) ? $_GET['ip'] : '';
		$this->registry['output']->__set('ip', $action);
		$sql_1 = "SELECT * FROM log_user WHERE log_ip = '" . $action . "' LIMIT 0,5";

		$stmt = $this->registry['conn']->query($sql_1);
		$result = $stmt->fetch(PDO::FETCH_OBJ);
		$this->registry['output']->__set('log_referer', $result->log_referer);
		$this->registry['output']->__set('log_browser', $result->log_browser);

		$this->registry['output']->__set('submenu', 'settings');
		$this->registry['output']->__show('/settings/detail');
	}

	function stats()
	{
		$action = isset($_GET['stats']) ? $_GET['stats'] : '';
	    switch($action)
	    {	 		case 'pages':
	 			'';
	 			break;

	 		case 'browsers':
	 			$sql_1 = "SELECT * FROM log_user WHERE log_browser = 'Chrome'";
	 			$sql_2 = "SELECT * FROM log_user WHERE log_browser = 'Firefox'";
	 			$sql_3 = "SELECT * FROM log_user WHERE log_browser = 'Opera'";
	 			$sql_4 = "SELECT * FROM log_user WHERE log_browser = 'Internet Explorer'";
	 			$sql_5 = "SELECT * FROM log_user WHERE log_browser = 'Other'";

	 			$result = $this->registry['conn']->query($sql_1);
				$Chrome = $result->rowCount();

				$result = $this->registry['conn']->query($sql_2);
				$Firefox = $result->rowCount();

				$result = $this->registry['conn']->query($sql_3);
				$Opera = $result->rowCount();

				$result = $this->registry['conn']->query($sql_4);
				$Explorer = $result->rowCount();

				$result = $this->registry['conn']->query($sql_5);
				$Other = $result->rowCount();

				$values=array(
								array($Chrome, "Chrome"),
								array($Firefox, "Firefox"),
								array($Opera, "Opera"),
								array($Explorer, "Internet Explorer"),
								array($Other, "Other")
							);
				$bar = new bar_graph();
				$bar->Draw($values);

				$display = '<img src="' . WEB_ROOT . 'admin/temp/bar-graph.png"><br>';
	 			break;

	 		case 'segments':
		 		$sql_1 = "SELECT * FROM tbl_records";
		 		$sql_2 = "SELECT * FROM buga";
				$sql_3 = "SELECT * FROM tbl_domain";
				$sql_4 = "SELECT * FROM tbl_email";
				$sql_5 = "SELECT * FROM tbl_ftp";
				$sql_6 = "SELECT * FROM tbl_mysql";

				$result = $this->registry['conn']->query($sql_1);
				$DNS = $result->rowCount();

				$result = $this->registry['conn']->query($sql_2);
				$Users = $result->rowCount();

				$result = $this->registry['conn']->query($sql_3);
				$Domains = $result->rowCount();

				$result = $this->registry['conn']->query($sql_4);
				$Emails = $result->rowCount();

				$result = $this->registry['conn']->query($sql_5);
				$FTP = $result->rowCount();

				$result = $this->registry['conn']->query($sql_6);
				$MySQL = $result->rowCount();

				 $values=array(
							array($DNS, "DNS Records"),
							array($Users, "Registed users"),
							array($Domains, "Domains"),
							array($Emails, "Email accounts"),
							array($FTP, "FTP accounts"),
							array($MySQL, "MySQL accounts")
						);
				$pie_chart= new pie_chart();
				$pie_chart->Draw($values);

				$display = '<img src="' . WEB_ROOT . 'admin/temp/verify.png"><br>';
	 			break;

			case 'visits':
				function odd($var)
				{
	    			return($var & 1);
				}
				$sql_1 = "SELECT * FROM log_pages ORDER BY page_id DESC LIMIT 1";
				$stmt = $this->registry['conn']->query($sql_1);
				$result = $stmt->fetch(PDO::FETCH_OBJ);
				$date = $result->page_date;
				$half = explode(' ', $date);
		        $split = explode('-', $half[0]);
		        $half[1] = "";
		        $first = $half[0] . " " . $half[1];
		        function createdate($backintime, $date)
		        {
		        	$half = explode(' ', $date);
		       		$split = explode('-', $half[0]);
		        	$half[1] = "00:00:00";
			        $day = $split[2] - $backintime;
			        $fulldate = "" . $split[0] . "-" . $split[1] . "-" . $day;
			        if($day < 1)
			        {
			        	$month = $split[1] - 2;
			        	$temp = array(0=>$month);
			        	$value = array_filter($temp, "odd");
			        	if(!array_key_exists('0', $value))
			        	{
			        		$temp = 30;
			        		$day = 30 + $day;
			        	}
			        	$fulldate = "" . $split[0] . "-" . $month . "-" . $day;
			          	if($month < 1)
			          	{

			          		$year = $split[0] - 1;
			          		$fulldate = "" . $year . "-" . $month . "-" . $day;
			          	}
			        }
			        return $fulldate;
				}
				$second = createdate(1,$date);
				$third  = createdate(2,$date);
				$fourth = createdate(3,$date);
				$fifth	= createdate(4,$date);
				$sixth	= createdate(5,$date);
				$seventh= createdate(6,$date);
				$sql_1 = "SELECT * FROM log_pages WHERE page_date > '" . $first . "'";
				$result = $this->registry['conn']->query($sql_1);
				$firstN = $result->rowCount();

				$sql_1 = "SELECT * FROM log_pages WHERE page_date > '" . $second . "' AND page_date < '" . $first . "'";
				$result = $this->registry['conn']->query($sql_1);
				$secondN = $result->rowCount();

				$sql_1 = "SELECT * FROM log_pages WHERE page_date > '" . $third . "' AND page_date < '" . $second . "'";
				$result = $this->registry['conn']->query($sql_1);
				$thirdN = $result->rowCount();

				$sql_1 = "SELECT * FROM log_pages WHERE page_date > '" . $fourth . "' AND page_date < '" . $third . "'";
				$result = $this->registry['conn']->query($sql_1);
				$fourthN = $result->rowCount();

				$sql_1 = "SELECT * FROM log_pages WHERE page_date > '" . $fifth . "' AND page_date < '" . $fourth . "'";
				$result = $this->registry['conn']->query($sql_1);
				$fifthN = $result->rowCount();

				$sql_1 = "SELECT * FROM log_pages WHERE page_date > '" . $sixth . "' AND page_date < '" . $fifth . "'";
				$result = $this->registry['conn']->query($sql_1);
				$sixthN = $result->rowCount();

				$sql_1 = "SELECT * FROM log_pages WHERE page_date > '" . $seventh . "' AND page_date < '" . $sixth . "'";
				$result = $this->registry['conn']->query($sql_1);
				$seventhN = $result->rowCount();

				$values=array(
								array($firstN, $first),
								array($secondN, $second),
								array($thirdN, $third),
								array($fourthN, $fourth),
								array($fifthN, $fifth),
								array($sixthN, $sixth),
								array($seventhN, $seventh)
							);
				$bar = new bar_graph();
				$bar->Draw($values);

				$pred = new pred_graph();
				$pred->Draw($values);

				$display = '<img src="' . WEB_ROOT . 'admin/temp/bar-graph.png">&nbsp;<img src="' . WEB_ROOT . 'admin/temp/pred-bar-graph.png">';
				break;

			default:
				$display = 'Please select from menu at the top';
		}
  		$this->registry['output']->__set('display', $display);
		$this->registry['output']->__set('ip', $action);
		$sql_1 = "SELECT * FROM log_user WHERE log_ip = '" . $action . "' LIMIT 0,5";
		$stmt = $this->registry['conn']->query($sql_1);
		$result = $stmt->fetch(PDO::FETCH_OBJ);
		$this->registry['output']->__set('log_referer', $result->log_referer);
		$this->registry['output']->__set('log_browser', $result->log_browser);

		$this->registry['output']->__set('submenu', 'settings');
		$this->registry['output']->__show('/settings/index');
	}
}