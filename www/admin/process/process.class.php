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
										0 => "SELECT domain_id FROM tbl_domain WHERE domain_id = '" . $this->feld['txtDomain'] . "'|0|Domain does not exists",
										1 => "SELECT user_id FROM buga WHERE user_id = '" . $this->feld['txtID'] . "'|0|User does not exist",
										2 => "SELECT ftp_username FROM tbl_ftp WHERE domain_id = '" . $this->feld['txtDomain'] . "' AND ftp_username = '" . $this->feld['txtFTP'] . "'|1|FTP user already exists under given domain");
				}
				if($this->array['type'] == 'modify')
				{
					$this->rowcount = array(0 => "SELECT domain_id FROM tbl_domain WHERE domain_id = '" . $this->feld['txtDomain'] . "'|0|Domain does not exists",
												1 => "SELECT user_id FROM buga WHERE user_id = '" . $this->feld['txtID'] . "'|0|User does not exist");
				}
			break;

			case 'domain':
				if($this->array['type'] == 'add')
				{
					$this->rowcount = array(
										0 => "SELECT domain_id FROM tbl_domain WHERE domain_name LIKE '%" . $this->feld['txtDomain'] . "%'|1|Domain already exists",
										1 => "SELECT user_id FROM buga WHERE user_id = '" . $this->feld['txtID'] . "'|0|User does not exist");
				}
				if($this->array['type'] == 'modify')
				{
					$this->rowcount = array(0 => "SELECT domain_id FROM tbl_domain WHERE domain_name LIKE '%" . $this->feld['txtDomain'] . "%'|1|Domain already exists",
											1 => "SELECT user_id FROM buga WHERE user_id = '" . $this->feld['txtID'] . "'|0|User does not exist");
				}
			break;

			case 'email':
				if($this->array['type'] == 'add')
				{
					$this->rowcount = array(
										0 => "SELECT domain_id FROM tbl_domain WHERE domain_id = '" . $this->feld['txtDomain'] . "'|0|Domain does not exists",
										1 => "SELECT user_id FROM buga WHERE user_id = '" . $this->feld['txtID'] . "'|0|User does not exist",
										2 => "SELECT email_name FROM tbl_email WHERE domain_id = '" . $this->feld['txtDomain'] . "' AND email_name = '" . $this->feld['txtEmail'] . "'|1|Email user already exists under given domain");
				}
				if($this->array['type'] == 'modify')
				{
					$this->rowcount = array(0 => "SELECT email_id FROM tbl_email WHERE email_name = '" . $this->feld['txtEmail'] . "' AND domain_id = '" . $this->feld['txtDomain'] . "'|1|Email already exists",
											1 => "SELECT user_id FROM buga WHERE user_id = '" . $this->feld['txtID'] . "'|0|User does not exist");
				}
			break;

			case 'mysql':
				if($this->array['type'] == 'add')
				{
					$this->rowcount = array(
										0 => "SELECT domain_id FROM tbl_domain WHERE domain_id = '" . $this->feld['txtDomain'] . "'|0|Domain does not exists",
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
					$this->rowcount = array(0 => "SELECT record_id FROM tbl_records WHERE record_name = '" . $this->feld['name'] . "'|1|Record already exists");
				}
				if($this->array['type'] == 'modify')
				{
					$this->rowcount = array(0 => "SELECT record_id FROM tbl_records WHERE record_name = '" . $this->feld['name'] . "'|1|Record already exists");
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
					$this->query = "INSERT INTO tbl_ftp (user_id, domain_id, ftp_username, ftp_password) VALUES('" . $this->feld['txtID'] . "', '" . $this->feld['txtDomain'] . "', '" . $this->feld['txtFTP'] . "', '" . $this->feld['txtFTPpass'] . "')";
				}
				if($this->array['type'] == 'modify')
				{
					$this->query = "UPDATE tbl_ftp SET user_id='" . $this->feld['txtID'] . "', domain_id='" . $this->feld['txtDomain'] . "', ftp_username='" . $this->feld['txtFTP'] . "', ftp_password=md5('" . $this->feld['txtFTPpass'] . "') WHERE ftp_id='" . $this->feld['c_ftp_id'] . "'";
				}
			break;

			case 'domain':
				if($this->array['type'] == 'add')
				{
					$dns_name = explode("http://", $this->feld['txtDomain']);
					$dns_name = explode("www.", $dns_name[0]);
					$this->query = "INSERT INTO tbl_domain (user_id, domain_name) VALUES('" . $this->feld['txtID'] . "', '" . $this->feld['txtDomain'] . "');
									INSERT INTO tbl_records (user_id, domain_name, dns_name, record_type, record_name)
									VALUE('" . $this->feld['txtID'] . "', '" . $this->feld['txtDomain'] . "', '" . $dns_name[1] . "', 'A', 'www'), ('" . $this->feld['txtID'] . "', '" . $this->feld['txtDomain'] . "', '" . $dns_name[1] . "', 'A', 'mail')";
				}
				if($this->array['type'] == 'modify')
				{
					$dns_name = explode("http://", $this->feld['txtDomain']);
					$dns_name = explode("www.", $dns_name[0]);
					$this->query = "UPDATE tbl_domain SET user_id='" . $this->feld['txtID'] . "', domain_name='" . $this->feld['txtDomain'] . "' WHERE domain_id='" . $this->feld['c_id'] . "';
									UPDATE tbl_records SET domain_name = '" . $this->feld['txtDomain'] . "', dns_name = '" . $dns_name[1] . "' WHERE domain_name = '" . $this->feld['c_domain'] . "'";
				}
			break;

			case 'email':
				if($this->array['type'] == 'add')
				{
					$this->query = "INSERT INTO tbl_email (user_id, domain_id, email_name, email_password) VALUES('" . $this->feld['txtID'] . "', '" . $this->feld['txtDomain'] . "', '" . $this->feld['txtEmail'] . "', '" . $this->feld['txtEmailpass'] . "')";
				}
				if($this->array['type'] == 'modify')
				{
					$this->query = "UPDATE tbl_email SET user_id='" . $this->feld['txtID'] . "', domain_id='" . $this->feld['txtDomain'] . "', email_name='" . $this->feld['txtEmail'] . "', email_password=md5('" . $this->feld['txtEmailpass'] . "') WHERE email_id='" . $this->feld['c_email_id'] . "'";
				}
			break;

			case 'mysql':
				if($this->array['type'] == 'add')
				{
					$this->query = "INSERT INTO tbl_mysql (user_id, domain_id, mysql_dbname, mysql_password) VALUES('" . $this->feld['txtID'] . "', '" . $this->feld['txtDomain'] . "', '" . $this->feld['txtmysql'] . "', '" . $this->feld['txtmysqlpass'] . "')";
				}
				if($this->array['type'] == 'modify')
				{
					$this->query = "UPDATE tbl_mysql SET user_id='" . $this->feld['txtID'] . "', domain_id='" . $this->feld['txtDomain'] . "', mysql_dbname='" . $this->feld['txtmysql'] . "' WHERE mysql_id='" . $this->feld['c_mysql_id'] . "'";
				}
			break;

			case 'dns':
				if($this->array['type'] == 'add')
				{
					$this->query = "INSERT INTO tbl_records (user_id, domain_name, dns_name, record_type, record_name)
									VALUES('" . $this->feld['user_id'] . "', '" . $this->feld['domain_name'] . "', '" . $this->feld['dns_name'] . "',
									'" . $this->feld['type'] . "', '" . $this->feld['name'] . "')";
				}
				if($this->array['type'] == 'modify')
				{
					$this->query = "UPDATE tbl_records SET record_name ='" . $this->feld['name'] . "', record_type ='" . $this->feld['type'] . "' WHERE record_id='" . $this->feld['c_id'] . "'";
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
					$this->query = "UPDATE tbl_settings SET dns_refresh = '" . $this->feld['dns_refresh'] . "',
					dns_retry = '" . $this->feld['dns_retry'] . "', dns_expire = '" . $this->feld['dns_expire'] . "',
					dns_minimum = '" . $this->feld['dns_minimum'] . "', dns_ip = '" . $this->feld['dns_ip'] . "'";
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
		{			process::getQuery();
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
			if($this->array['class'] == "client")
			{				$sql = "SELECT * FROM buga WHERE user_login = '" . $this->feld['txtusername'] . "' AND user_password = '" . md5($this->feld['txtpass'] . '' . $this->feld['txtusername']) . "'";
				$stmt = $this->registry['conn']->query($sql);
				$result = $stmt->fetch(PDO::FETCH_OBJ);
				$user_id = $result->user_id;
				$sql = "INSERT INTO tbl_userinfo (user_regdate, user_id) VALUES (NOW(), '" . $user_id . "');";
				$this->registry['conn']->exec($sql);
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
			var_dump($this->registry['conn']->exec($this->query));

			$_SESSION['errorMessage'] = "Successfully modified!";
		}
	}

	public function search()
	{
		if(isset($_POST['submit']))
		{
			process::doSearch();
		}
		else
		{
			process::showsearch();
		}
	}

	private function doSearch()
	{
		@$userid 		= trim($_POST['txtUser']);
		@$domain		= trim($_POST['txtDomain']);
		@$ftp_username	= trim($_POST['txtFTP']);


		$this->sql_2= 	"SELECT *
					FROM tbl_ftp
					WHERE `domain_id`='$domain' AND `ftp_username` LIKE '%$ftp_username%' AND `user_id` = '$userid'
					ORDER BY ftp_id";
		$this->pages = new pages($this->registry);
		$this->sql = $pages->setSQL($this->sql_2);
		$result = $this->registry['conn']->query($this->sql);
		$this->numrows = $result->rowCount();
        process::showresult();
    }

    public function showresult()
    {
		print "<table border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"1\" class=\"text\" width=\"800px\">\n";
		print "<tr align=\"center\" id=\"listTableHeader\">\n";
		print "<td>User</td>\n";
		print "<td>Domain name</td>\n";
		print "<td>FTP user</td>\n";
		print "<td width=\"70\">Modify</td>\n";
		print "<td width=\"70\">Delete</td>\n";
		print "</tr>\n";

		if ($this->numrows > 0) {
			$i = 0;
			foreach ($this->registry['conn']->query($this->sql) as $row){
				$sql2 = "SELECT * FROM buga WHERE user_id =" . $row['user_id'];
				$stmt2 = $this->registry['conn']->query($sql2);
				$obj2 = $stmt2->fetch(PDO::FETCH_OBJ);

				$sql3 = "SELECT * FROM tbl_domain WHERE domain_id =" . $row['domain_id'];
				$stmt3 = $this->registry['conn']->query($sql3);
				$obj3 = $stmt3->fetch(PDO::FETCH_OBJ);
				print '<tr class=row1>';
				print '<td><a href="' . WEB_ROOT . 'admin/clients/detail/&id=' . $row['user_id'] . '">' . $obj2->user_login . '</a></td>';
				print '<td>' . $obj3->domain_name . '</td>';
				print '<td>' . $row['ftp_username'] . '</td>';
				print '<td width="70" align="center"><a href="' . WEB_ROOT . 'admin/ftp/modify/&id=' . $row['ftp_id'] . '">Modify</a></td>';
				print '<td width="70" align="center"><a href="javascript:deleteEntry(' . $row['ftp_id'] . ');">Delete</a></td>';
				print '</tr>';
			}
			print "<tr>\n";
			print "<td colspan=\"5\" align=\"center\">\n";

			$pages->pages($this->sql_2);
			print "</td> \n";
			print "</tr> \n";

		}
		else
		{
			print "<tr> \n";
			print "<td colspan=\"5\" align=\"center\">No entries</td> \n";
			print "</tr> \n";

		}
		print "<tr> \n";
		print "<td colspan=\"5\">&nbsp;</td> \n";
		print "</tr> \n";
		print "</table> \n";
		print "<p>&nbsp;</p> \n";
		print "</form>\n";
	}

	public function showsearch()
	{
		print "<form action=\"\" method=\"post\" name=\"frm\" id=\"frm\">\n";
		print "<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"1\" class=\"text\"> \n";
		print "<tr align=\"left\" id=\"listTableHeader\"> <td></td>\n";
		print "<td><b>Search</b></td> \n";
		print "</tr> \n";
		print "<tr class=row1> \n";
		print "<td width=150 class=\"label\">FTP username</td>\n";
		print "<td class=\"content\"><input name=\"txtFTP\" type=\"text\" class=\"box\" id=\"txtFTP\" size=\"50\" maxlength=\"255\"></td>\n";
		print "</tr>\n";
		print "<tr class=row1> \n";
		print "<td width=150 class=\"label\">Domain ID</td>\n";
		print "<td class=\"content\"><input name=\"txtDomain\" type=\"text\" class=\"box\" id=\"txtDomain\" size=\"50\" maxlength=\"255\"></td>\n";
		print "</tr>\n";
		print "<tr class=row1> \n";
		print "<td width=150 class=\"label\">User ID</td>\n";
		print "<td class=\"content\"><input name=\"txtUser\" type=\"text\" class=\"box\" id=\"txtUser\" size=\"50\" maxlength=\"100\"></td>\n";
		print "</tr>	\n";
		print "</table>\n";
		print "<div align=center></p><input name=\"btn\" type=\"submit\" id=\"btn\" value=\"Search\" class=\"box\"></div>\n";
		print "</form>\n";
	}
}