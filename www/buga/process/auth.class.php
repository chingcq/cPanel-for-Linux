<?php
/**
 * Authorisation
 * runned in root file of place which has to be secured with auth system
 * to run used 'new Auth($registry);'
 * only requied option is registry to link class auth with database
 */
Class auth
{
	/**
	 * List of vars
	 */
	private $userbame;
	private $password;
	private $sql;
	protected $registry;
	private $result;
	private $passwordmd5;

	/**
	 * First thing is to link class with main registry
	 */
	public function __construct($registry)
	{
		$this->registry = $registry;
	}
	/**
	 * used to check users right to view pages, if user has correct session data, then he will be allowed in
	 * otherways he will be logged out.
	 */
	public function checkUser()
	{
		/**
		 * Checking if $_SESSION exists if not header to login page and exit script
		 */
		if(!isset($_SESSION['buga']))
		{
			header('Location: /buga/login.php');
			exit;
		}
		else
		{
			/**
			 * If $_SESSION exists we check if session contains values which exist in database.
			 * session will contain password and username, which have "|" sign between them
			 * $sql contains a query which will be used to check if session is true.
			 */
			$felder = explode("|" , $_SESSION['buga']);
			$this->sql = "SELECT user_id FROM `buga` WHERE `user_login` = '" . $felder[1] . "' AND `user_password` = '" . $felder[0] . "'";
	        $this->result = $this->registry['conn']->query($this->sql);
            $count = $this->result->rowCount();

			/**
			 * If we found one row with values given in session then session is true, alse it false
			 * and 'errorMessage' is set and starting logout function
			 */
	        if($count == 1)
	        {
	        }
	        else
	        {
	            $_SESSION['errorMessage'] = 'Wrong username or password';
	            auth::doLogout();
	        }
		}
	}
	/**
	 * Function which logs user in
	 */
	public function doLogin()
	{
		/**
		 * We get post values which stored in pre declared variables
		 * both $_POST values are being checked. All whitespaces are being removed, slashes removed and check
		 * if value is correct with mysql
		 * After that declare variable passwordmd5 which will contain md5 password which will be used in database
		 */
	    $this->username = mysql_escape_string(stripslashes(trim($_POST['txtUserName'])));
	    $this->password = mysql_escape_string(stripslashes(trim($_POST['txtPassword'])));
	    $this->passwordmd5 = md5($this->password . '' . $this->username);

		/**
		 * First check, check if $username is empty, if yes set errorMessage
		 * Second check if $password is empty, if yes set errorMessage
		 */
	    if(!$this->username)
	    {
	         $_SESSION['errorMessage'] ='You must enter your username';
	    }
	    elseif(!$this->password)
	    {
	         $_SESSION['errorMessage'] ='You must enter the password';
	    }
	    else
	    {
			/**
			 * If every thing is ok, then we move to next stage.
			 * We set $sql query and execute it.
			 * $count contains number of rows from $sql query.
			 */
	        $this->sql = "SELECT user_id FROM `buga` WHERE `user_login` = '" . $this->username . "' AND `user_password` = '" . $this->passwordmd5 . "'";
	        $this->result = $this->registry['conn']->query($this->sql);
            $count = $this->result->rowCount();
			/**
			 * If $count is 1 setting session['buga'] with user data.
			 * Log data and ip with username in database. Header user to main form. and exit script.
			 * if $count not 1 then set 'errorMessage' and user with be asked to re-enter data.
			 */
	        if($count == 1)
	        {
				$this->sql = "INSERT INTO lastlogin (user_login, lastlogin_ip, lastlogin_date) VALUES('" . $this->username . "', '" . $_SERVER['REMOTE_ADDR'] . "', NOW())";
	            $this->registry['conn']->query($this->sql);
	            $sql = "SELECT * FROM buga WHERE user_login = '" . $this->username . "' AND `user_password` = '" . $this->passwordmd5 . "'";
				$stmt = $this->registry['conn']->query($sql);
				$result = $stmt->fetch(PDO::FETCH_OBJ);
				$_SESSION['buga'] = $this->passwordmd5 . "|" . $this->username . "|" . $result->user_id;
				$_SESSION['number'] = $result->user_id;

	            header('Location: index.php');
	            exit;
	        }else{
	            $_SESSION['errorMessage'] = 'Wrong username or password';
	        }
	   	}
	}


	/**
	 * Logout function
	 * Check if session['buga'] exists
	 * if yes, remove and unregister it.
	 * header user to logiun page and set 'errorMessage'
	 */
	public function doLogout()
	{
        if (isset($_SESSION['buga']))
        {
			unset($_SESSION['buga']);
			session_unregister('buga');
		}

		header('Location: /buga/login.php');
		$_SESSION['errorMessage'] = "You were successfully logged out!";
		exit;
	}
}