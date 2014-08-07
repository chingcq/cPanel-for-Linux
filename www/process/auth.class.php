<?php
Class Auth{
	private $userName;
	private $password;
	private $data;
	private $sql;
	private $result;
	private $row;
	
	private function checkUser(){
		if(!isset($session->__get('fake')){
			header('Location: /login/');
			exit;
		}
	}

	private function doLogin($userName, $password){
    $this->userName = $userName;
    $this->password = md5($password . $this->userName . SPEC_KEY);
    //post class strtolower(stripslashes(mysql_real_escape_string($var)))

    if(!$this->userName){
        $session->__set('errorMessage','You must enter your username');
    }elseif(!$this->password){
        $session->__set('errorMessage','You must enter the password');
    }else{
        $this->sql = "SELECT login FROM klpt WHERE login = '$this->userName' AND password = '$this->password'"; 
        $this->result = dbQuery($this->sql);
    
        if(dbNumRows($this->result) == 1){
            $this->row = dbFetchAssoc($result);
			$this->data = md5($this->password . $this->userName);
            $session->__set('fake',$data);

            if($session->__get('login_return_url')){
                header('Location: ' . $session->__get('login_return_url'));
                exit;
            }else{
                header('Location: /buga/index');
                exit;
            }
        }else{
            $session->__set('errorMessage','Wrong username or password');
        }
    }
  
    return $session->__get('errorMessage');
	}


	private function doLogout(){
		if($session->__get('fake')){
			$session->__unset('fake');	
		}

		header('Location: /login/');
		exit;
	}
}