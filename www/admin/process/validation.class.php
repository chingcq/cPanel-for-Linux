<?php
/**
 * validates string
 * to use
 * $validate = new validation;
 * if(!$validate->check($ftp_username, 'LandM'))
 * {
 * 		$_SESSION['errorMessage'] = "Username has incorrect format";
 * 		return;
 * }
 */			
Class validation
{
	/**
	 * declaring vars
	 */
	private $onlyLetters = "/^[a-zA-Z]+$/i";
	private $onlyNumbers = "/^[0-9]+$/";
	private $LandN = "/^[0-9a-zA-Z_]+$/i";
	private $email = "/^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]*\.)+[a-z]{2,4}$/i";
	private $domain = "/^([0-9a-zA-Z][0-9a-zA-Z-]*\.)+[a-zA-Z]{2,4}$/";

	public function check($str, $case)
	{
		/**
		 * $case will contain check which we have to do
		 * if we have $case in one of the cases set $match value with correct validation
		 */
		switch($case)
		{
			case 'onlyLetters':
				$match = $this->onlyLetters;
				break;
			case 'onlyNumbers':
				$match = $this->onlyNumbers;
				break;
			case 'LandN':
				$match = $this->LandN;
				break;
			case 'email':
				$match = $this->email;
				break;
			case 'domain':
				$match = $this->domain;
				break;
			default :
				echo "Whats up dog";
				exit;
		}
		$str = trim(strtolower(str_replace(" ", '', $str)));
		
		/**
		 * Now we have $match value, so we continue
		 * firstly we modify $str value, make sure that it's in correct format,
		 * first make it without any white spaces, lower letters, then remove slashes, and make sure
		 * that it's correct mysql string
		 * then we return if some thing was found with 'return'
		 */
	    return preg_match($match, $str);
		
	}
}
?>