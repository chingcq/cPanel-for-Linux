<?php
class process
{
	protected $registry;
	private $feld = array();
	private $array = array();
	private $sql;
	private $numrows;
	private $sql_2;
	private $pages;
	private $rowcount;
	private $query;
	private $match = array();

	public function __construct($registry, $array)
	{
		$this->registry = $registry;
		$this->array = $array;
		$type = $this->array['type'];

		switch($type)
		{
			case 'add':
				process::add();
				break;

			case 'modify':
				process::modify();
				break;

			case 'delete':
				process::delete();
				break;

			case 'search':
				process::search();
				break;

			default:
				'';
		}

		if($type == "delete")
		{
			$transfer = explode('&', $_SERVER['REQUEST_URI']);
			echo "<script>document.location='" . $transfer[0] . "'</script>";
		}else{
			echo "<script>document.location='" . $_SERVER['REQUEST_URI'] . "'</script>";
		} 
	}

	private function getMatch()
	{
		switch($this->array['class'])
		{
			case 'ftp':
				$this->match = array(0 => "$this->feld['txtFTP'] != $this->feld['c_ftp_username']|SELECT ftp_username FROM tbl_ftp WHERE domain_id = '" . $this->feld['txtDomain'] . "' AND ftp_username = '" . $this->feld['txtFTP'] . "'|FTP user already exists under given domain");

			default:
				'';
		}
	}

	private function getQuery()
	{
		switch($this->array['class'])
		{
			case 'ftp':
				if($this->array['type'] == 'add')
				{
					$this->rowcount = array(
										0 => "SELECT id FROM domains WHERE domain_id = '" . $this->feld['txtDomain'] . "'|0|Domain does not exists",
										1 => "SELECT user_id FROM buga WHERE user_id = '" . $this->feld['txtID'] . "'|0|User does not exist",
										2 => "SELECT Username FROM ftpd WHERE domain_id = '" . $this->feld['txtDomain'] . "' AND User = '" . $this->feld['txtFTP'] . "'|1|FTP user already exists under given domain");
				}
				if($this->array['type'] == 'modify')
				{
					$this->rowcount = array(0 => "SELECT id FROM domains WHERE id = '" . $this->feld['txtDomain'] . "'|0|Domain does not exists",
												1 => "SELECT user_id FROM buga WHERE user_id = '" . $this->feld['txtID'] . "'|0|User does not exist");
				}
			break;

			case 'domain':
				if($this->array['type'] == 'add')
				{
					$this->rowcount = array(
										0 => "SELECT id FROM domains WHERE name LIKE '%" . $this->feld['txtDomain'] . "%'|1|Domain already exists",
										1 => "SELECT user_id FROM buga WHERE user_id = '" . $this->feld['txtID'] . "'|0|User does not exist");
				}
				if($this->array['type'] == 'modify')
				{
					$this->rowcount = array(0 => "SELECT id FROM domains WHERE name LIKE '%" . $this->feld['txtDomain'] . "%'|1|Domain already exists",
											1 => "SELECT user_id FROM buga WHERE user_id = '" . $this->feld['txtID'] . "'|0|User does not exist");
				}
			break;

			case 'email':
				if($this->array['type'] == 'add')
				{
					$this->rowcount = array(
										0 => "SELECT id FROM domains WHERE id = '" . $this->feld['txtDomain'] . "'|0|Domain does not exists",
										1 => "SELECT user_id FROM buga WHERE user_id = '" . $this->feld['txtID'] . "'|0|User does not exist",
										2 => "SELECT email FROM users WHERE domain_id = '" . $this->feld['txtDomain'] . "' AND email = '" . $this->feld['txtEmail'] . "'|1|Email user already exists under given domain");
				}
				if($this->array['type'] == 'modify')
				{
					$this->rowcount = array(#0 => "SELECT email_id FROM users WHERE email = '" . $this->feld['txtEmail'] . "' AND domain_id = '" . $this->feld['txtDomain'] . "'|1|Email already exists",
											0 => "SELECT user_id FROM buga WHERE user_id = '" . $this->feld['txtID'] . "'|0|User does not exist");
				}
			break;

			case 'mysql':
				if($this->array['type'] == 'add')
				{
					$this->rowcount = array(
										0 => "SELECT id FROM domains WHERE domain_id = '" . $this->feld['txtDomain'] . "'|0|Domain does not exists",
										1 => "SELECT user_id FROM buga WHERE user_id = '" . $this->feld['txtID'] . "'|0|User does not exist",
										2 => "SELECT mysql_dbname FROM tbl_mysql WHERE domain_id = '" . $this->feld['txtDomain'] . "' AND mysql_dbname = '" . $this->feld['txtmysql'] . "'|1|mysql user already exists under given domain");
				}
				if($this->array['type'] == 'modify')
				{
					$this->rowcount = array(0 => "SELECT mysql_id FROM tbl_mysql WHERE mysql_dbname = '" . $this->feld['txtmysql'] . "' AND domain_id = '" . $this->feld['txtDomain'] . "'|1|mysql already exists",
											1 => "SELECT user_id FROM buga WHERE user_id = '" . $this->feld['txtID'] . "'|0|User does not exist");
				}
			break;

            case 'dns':
				if($this->array['type'] == 'add')
				{
					$this->rowcount = array(0 => "SELECT id FROM records WHERE name = '" . $this->feld['name'] . "'|1|Record already exists");
				}
				if($this->array['type'] == 'modify')
				{
					#$this->rowcount = array(0 => "SELECT id FROM records WHERE name = '" . $this->feld['name'] . "'|1|Record already exists");
				}
			break;


			case 'client':
				if($this->array['type'] == 'add')
				{
					$this->rowcount = array(
										0 => "SELECT user_id FROM buga WHERE user_login = '" . $this->feld['txtusername'] . "'|1|User already exists");
				}
			break;

			default:
				'';
		}
	}

	public function Query()
	{
		switch($this->array['class'])
		{
			case 'ftp':
				if($this->array['type'] == 'add')
				{


		$sql3 = "SELECT * FROM domains WHERE id =" . $this->feld['txtDomain'];
		$stmt3 = $this->registry['conn']->query($sql3);
		$obj3 = $stmt3->fetch(PDO::FETCH_OBJ);
		$domain_name = $obj3->name;
		$domain_name = '/home/www.' . $domain_name;
					$this->query = "INSERT INTO ftpd (user_id, domain_id, User, Password, Dir, status, Uid, Gid, ULBandwidth, DLBandwidth, ipaccess, QuotaSize) VALUES('" . $this->feld['txtID'] . "', '" . $this->feld['txtDomain'] . "', '" . $this->feld['txtFTP'] . "', md5('" . $this->feld['txtFTPpass'] . "'), '" . $domain_name . "', '1', 2001, 2001, 100, 100, '*', 50)";
				}
				if($this->array['type'] == 'modify')
				{
							$sql3 = "SELECT * FROM domains WHERE id =" . $this->feld['txtDomain'];
		$stmt3 = $this->registry['conn']->query($sql3);
		$obj3 = $stmt3->fetch(PDO::FETCH_OBJ);
		$domain_name = $obj3->name;
		$domain_name = '/home/www.' . $domain_name;
					$this->query = "UPDATE ftpd SET user_id='" . $this->feld['txtID'] . "', domain_id='" . $this->feld['txtDomain'] . "',User='" . $this->feld['txtFTP'] . "', Password = md5('" . $this->feld['txtFTPpass'] . "'), Dir = '" . $domain_name . "' WHERE ftp_id='" . $this->feld['c_ftp_id'] . "'";
				}
			break;

			case 'domain':
				if($this->array['type'] == 'add')
				{
				
				$dns_name = explode("http://", $this->feld['txtDomain']);
				$dns_name = explode("www.", $dns_name[0]);
				if($dns_name[1] == ''){
					$dns_name = $this->feld['txtDomain'];
				}else{
					$dns_name = $dns_name[1];
				}
					$this->query = "INSERT INTO domains (user_id, name) VALUES('" . $this->feld['txtID'] . "', '" . $dns_name . "')";
				}
				if($this->array['type'] == 'modify')
				{
					$dns_name = explode("http://", $this->feld['txtDomain']);
					$dns_name = explode("www.", $dns_name[0]);
					if($dns_name[1] == ''){
						$dns_name = $this->feld['txtDomain'];
					}else{
						$dns_name = $dns_name[1];
					}
				
				$sql = "SELECT * FROM tbl_settings";
				$stmt = $this->registry['conn']->query($sql);
				$result = $stmt->fetch(PDO::FETCH_OBJ);
				$ip = $result->dns_ip;
				$ttl = $result->dns_ttl;
				
					$this->query = "UPDATE domains SET user_id='" . $this->feld['txtID'] . "', name='" . $this->feld['txtDomain'] . "' WHERE id='" . $this->feld['c_id'] . "';DELETE FROM records WHERE domain_id = '" . $this->feld['c_id'] . "';INSERT INTO `records` (`user_id`, `domain_id`, `name`, `type`, `content`, `ttl`, `prio`, `change_date`) VALUES
('" . $this->feld['txtID'] . "',   '" . $this->feld['c_id'] . "', 'mail." . $dns_name . "', 'A', '" . $ip . "', '" . $ttl . "', 0, 1271928883),
('" . $this->feld['txtID'] . "',   '" . $this->feld['c_id'] . "', 'www." . $dns_name . "', 'A', '" . $ip . "', '" . $ttl . "', 0, 1271928872),
('" . $this->feld['txtID'] . "',   '" . $this->feld['c_id'] . "', '" . $dns_name . "', 'MX', 'mail." . $dns_name . "', '" . $ttl . "', 10, 1271928914),
('" . $this->feld['txtID'] . "',   '" . $this->feld['c_id'] . "', '" . $dns_name . "', 'A', '" . $ip . "', '" . $ttl . "', 0, 1271928994);";
				}
			break;

			case 'email':
				if($this->array['type'] == 'add')
				{
					$this->query = "INSERT INTO users (user_id, domain_id, email, password) VALUES('" . $this->feld['txtID'] . "', '" . $this->feld['txtDomain'] . "', '" . $this->feld['txtEmail'] . "', ENCRYPT('" . $this->feld['txtEmailpass'] . "'))";
				}
				if($this->array['type'] == 'modify')
				{
					$this->query = "UPDATE users SET user_id='" . $this->feld['txtID'] . "', domain_id='" . $this->feld['txtDomain'] . "', email = '" . $this->feld['txtEmail'] . "', password=ENCRYPT('" . $this->feld['txtEmailpass'] . "') WHERE email_id='" . $this->feld['c_email_id'] . "'";
				}
			break;

			case 'mysql':
				if($this->array['type'] == 'add')
				{
					$this->query = "INSERT INTO tbl_mysql (user_id, domain_id, mysql_username, mysql_password, mysql_dbname) VALUES('" . $this->feld['txtID'] . "', '" . $this->feld['txtDomain'] . "', '" . $this->feld['txtmysql'] . "', '" . $this->feld['txtpass'] . "', '" . $this->feld['txtdb'] . "')";
				}
				if($this->array['type'] == 'modify')
				{
					$this->query = "UPDATE tbl_mysql SET user_id='" . $this->feld['txtID'] . "', domain_id='" . $this->feld['txtDomain'] . "', mysql_username='" . $this->feld['txtmysql'] . "' WHERE mysql_id='" . $this->feld['c_mysql_id'] . "'";
				}
			break;

			case 'dns':
				if($this->array['type'] == 'add')
				{
					$this->query = "INSERT INTO records (user_id, domain_id, type, name, content)
									VALUES('" . $this->feld['user_id'] . "', '" . $_SESSION['dns']  . "', 
									'" . $this->feld['type'] . "', '" . $this->feld['name'] . "', '" . $this->feld['content'] . "')";
				}
				if($this->array['type'] == 'modify')
				{
					$this->query = "UPDATE records SET name ='" . $this->feld['name'] . "', type ='" . $this->feld['type'] . "', content = '" . $this->feld['content'] . "' WHERE id='" . $this->feld['c_id'] . "'";
				}
			break;

			case 'pass-mod':
				if($this->array['type'] == 'modify')
				{
					$this->query = "UPDATE klpt SET password = '" . $this->feld['txtpass'] . "'";
				}
			break;

			case 'client':
				if($this->array['type'] == 'add')
				{
					$this->query = "INSERT INTO buga (user_login, user_password) VALUES('" . $this->feld['txtusername'] . "', '" . md5($this->feld['txtpass'] . '' . $this->feld['txtusername']) . "');";
				}
				if($this->array['type'] == 'modify')
				{
					$this->query = "UPDATE tbl_userinfo SET user_name = '" . $this->feld['user_name'] . "',
					user_surname = '" . $this->feld['user_surname'] . "', user_company = '" . $this->feld['user_company'] . "',
					user_email = '" . $this->feld['user_email'] . "', user_address1 = '" . $this->feld['user_address1'] . "',
					user_address2 = '" . $this->feld['user_address2'] . "', user_city = '" . $this->feld['user_city'] . "',
					user_country = '" . $this->feld['Country'] . "', user_postcode = '" . $this->feld['user_postcode'] . "',
					user_telephone = '" . $this->feld['user_telephone'] . "', user_memo = '" . $this->feld['mtxDescription'] . "',
					user_gender = '" . $this->feld['user_gender'] . "', user_aged = '" . $this->feld['user_aged'] . "',
					user_agem = '" . $this->feld['user_agem'] . "', user_agey = '" . $this->feld['user_agey'] . "'
					WHERE user_id = '" . $this->feld['user_info_id'] . "'";
				}
			break;

			case 'dns-settings':
				if($this->array['type'] == 'modify')
				{
					$this->query = "UPDATE tbl_settings SET dns_ip = '" . $this->feld['dns_ip'] . "'; UPDATE records SET content = '" . $this->feld['dns_ip'] . "' WHERE content = '" . $this->feld['current_ip'] . "'";
				}
			break;
			default:
				'';
		}
		print $this->query;
	}

	private function trim()
	{
		if($this->array['task']['trim'] == 1)
		{
			$felder = explode ('|' , $this->array['trim']);
			foreach($felder as $feld)
			{
				$this->feld[$feld] = mysql_escape_string(stripslashes(trim($_POST[$feld])));
			}
		}
	}

	private function nontrim()
	{
		if($this->array['task']['nontrim'] == 1)
		{
			$felder = explode ('|' , $this->array['nontrim']);
			foreach($felder as $feld)
			{
				$this->feld[$feld] = mysql_escape_string(stripslashes($_POST[$feld]));
			}
		}
	}

	private function emptycheck()
	{
		if($this->array['task']['empty'] == 1)
		{
			$felder = explode ('|' , $this->array['empty']);
			foreach($felder as $feld)
			{
				if($_POST[$feld] == "")
				{
					$_SESSION['errorMessage']="Please fill in all fields which marked with asterisk(*)";
				}
			}
		}
	}

	private function otherfields()
	{
		if($this->array['task']['otherfields'] == 1)
		{
			$felder = explode ('|' , $this->array['otherfields']);
			foreach($felder as $feld)
			{
				$this->feld[$feld] = $_POST[$feld];
			}
		}
	}

	private function validate()
	{
		if($this->array['task']['validate'] == 1)
		{
			$validate = new validation();
			$max = count($this->array['validate']);
			for($i = 0; $i < $max; $i++)
			{
				$felder = explode('|', $this->array['validate'][$i]);
				if(!$validate->check($this->feld[$felder[0]], $felder[1]))
				{
					$_SESSION['errorMessage'] = $felder[2];
				}

			}
		}
	}

	public function rowcount()
	{
		if($this->array['task']['match'] == 1)
		{			process::getQuery();
			$max = count($this->rowcount);
			for($i = 0; $i < $max; $i++)
			{
				$felder = explode('|', $this->rowcount[$i]);
				$sql = $felder[0];

				$result = $this->registry['conn']->query($sql);
				$numrows = $result->rowCount();
				if($numrows == $felder[1])
				{
					$_SESSION['errorMessage']= $felder[2];
				}
			}
		}
	}

	private function md5()
	{
		if($this->array['task']['md5'] == 1)
		{
			$felder = explode ('|' , $this->array['md5']);
			foreach($felder as $feld)
			{
				$this->feld[$feld] = md5($this->feld[$feld]);
			}
		}
	}

	public function match()
	{
		$max = count($this->match);
			for($i = 0; $i < $max; $i++)
			{
				$felder = explode('|', $this->match[$i]);
				if($felder[0])
				{
					$sql = $felder[1];
					$result = $this->registry['conn']->query($sql);
					$numrows = $result->rowCount();
					if($numrows == 1)
					{
						$_SESSION['errorMessage']= $felder[2];
					}
				}
			}
	}


	private function delete()
	{
		if (isset($_GET['Id']) && (int)$_GET['Id'] > 0)
		{
			$Id = (int)$_GET['Id'];
		} else {
			header('Location: index.php');
		}
		$max = count($this->array['delete']);
		for($i = 0; $i < $max; $i++)
		{
			$felder = explode('|', $this->array['delete'][$i]);
			$sql = "DELETE FROM " . $felder[0] . " WHERE " . $felder[1] . " = '" . $Id . "'";
			$reg = $this->registry['conn']->query($sql);
			if($this->array['class'] == 'domain')
			{
				$sql = "DELETE FROM ftpd WHERE domain_id = '" . $Id . "'; DELETE FROM records WHERE domain_id = '" . $Id . "'; DELETE FROM users WHERE domain_id = '" . $Id . "'";
				$this->registry['conn']->exec($sql);
			}
		}
	}

	public function add()
	{
		unset($_SESSION['errorMessage']);
		session_unregister('errorMessage');
		process::emptycheck();

		if($_SESSION['errorMessage'] == '')
		{
			process::trim();
			process::nontrim();
			process::otherfields();
			process::validate();
			process::getQuery();
			process::rowcount();
		}

		if($_SESSION['errorMessage']=='')
		{
			process::md5();
			process::Query();
			$this->registry['conn']->exec($this->query);
			switch($this->array['class'])
			{
				case 'client':				$sql = "SELECT * FROM buga WHERE user_login = '" . $this->feld['txtusername'] . "' AND user_password = '" . md5($this->feld['txtpass'] . '' . $this->feld['txtusername']) . "'";
				$stmt = $this->registry['conn']->query($sql);
				$result = $stmt->fetch(PDO::FETCH_OBJ);
				$user_id = $result->user_id;
				$sql = "INSERT INTO tbl_userinfo (user_regdate, user_id) VALUES (NOW(), '" . $user_id . "');";
				$this->registry['conn']->exec($sql);
				break;
				
				
				
				case 'email':
				mail($this->feld['txtEmail'], 'Administration', 'Your settings were updated!', 'From: Admin');
				break;
				
				case 'domain':
				$dns_name = explode("http://", $this->feld['txtDomain']);
				$dns_name = explode("www.", $dns_name[0]);
				if($dns_name[1] == ''){
					$dns_name = $this->feld['txtDomain'];
				}else{
					$dns_name = $dns_name[1];
				}
			

				$sql = "SELECT * FROM domains WHERE user_id = '" . $this->feld['txtID'] . "' AND name = '" . $dns_name . "'";
				$stmt = $this->registry['conn']->query($sql);
				$result = $stmt->fetch(PDO::FETCH_OBJ);
				$domain_id = $result->id;
				
				$sql = "SELECT * FROM tbl_settings";
				$stmt = $this->registry['conn']->query($sql);
				$result = $stmt->fetch(PDO::FETCH_OBJ);
				$ip = $result->dns_ip;
				$ttl = $result->dns_ttl;
				
				$sql = "INSERT INTO `records` (`user_id`, `domain_id`, `name`, `type`, `content`, `ttl`, `prio`, `change_date`) VALUES
('" . $this->feld['txtID'] . "',  '" . $domain_id . "', 'mail." . $dns_name . "', 'A', '" . $ip . "', '" . $ttl . "', 0, 1271928883),
('" . $this->feld['txtID'] . "',  '" . $domain_id . "', 'www." . $dns_name . "', 'A', '" . $ip . "', '" . $ttl . "', 0, 1271928872),
('" . $this->feld['txtID'] . "',  '" . $domain_id . "', '" . $dns_name . "', 'MX', 'mail." . $dns_name . "', '" . $ttl . "', 10, 1271928914),
('" . $this->feld['txtID'] . "',  '" . $domain_id . "', '" . $dns_name . "', 'A', '" . $ip . "', '" . $ttl . "', 0, 1271928994);";
$this->registry['conn']->query($sql);
$sql = "CREATE DATABASE `" . $dns_name . "` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;CREATE USER '" . $dns_name . "'@'localhost' IDENTIFIED BY '" . $dns_name . "';GRANT SELECT , INSERT , UPDATE , DELETE , CREATE , DROP ON `" . $dns_name . "` . * TO '" . $dns_name . "'@'localhost';;FLUSH PRIVILEGES;";
			$result = $this->registry['conn']->query($sql);
				break;
				default:
				'';
			}
			$_SESSION['errorMessage'] = "Successfully added!";
		}
	}

	public function modify()
	{
		unset($_SESSION['errorMessage']);
		session_unregister('errorMessage');
		process::emptycheck();

		if($_SESSION['errorMessage'] == '')
		{
			process::trim();
			process::nontrim();
			process::otherfields();
			process::validate();
			process::getMatch();
			process::match();
			process::rowcount();
		}
		if($_SESSION['errorMessage']=='')
		{
			process::md5();
			process::Query();
			$this->registry['conn']->exec($this->query);
			switch($this->array['class'])
			{
				case 'mysql':
				$sql = "DROP DATABASE `db_" . $this->feld['txtID'] . "`REVOKE ALL PRIVILEGES, GRANT OPTION FROM '" . $this->feld['txt_c_mysql'] . "';DROP USER '" . $this->feld['txt_c_mysql'] . "';CREATE DATABASE IF NOT EXISTS `db_" . $this->feld['txtID'] . "` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;CREATE USER '"  . $this->feld['txtmysql'] . "'@'localhost' IDENTIFIED BY '" . $this->feld['txtpass'] . "'; GRANT CREATE,SELECT,INSERT,UPDATE,DELETE ON tbl_" . $this->feld['txtID'] . ".* TO '" . $this->feld['txtmysql'] . "'@'localhost';FLUSH PRIVILEGES;";
				$this->registry['conn']->exec($sql);
				break;
				
				case 'email':
				mail($this->feld['txtEmail'], 'Administration', 'Your settings were updated!', 'From: Admin');
				break;
				default:
				'';	
				}
			$_SESSION['errorMessage'] = "Successfully modified!";
		}
	}
}