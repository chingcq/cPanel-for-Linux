<?php
Class Validate{
	private $str;
	private $onlyLetters = "^[a-z]";
	private $onlyNumbers = "^[0-9]";
	private $LandM = "^[0-9a-z'\.,/-]";
	private $email = "^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]*\.)+[a-z]{2,4}$";

	private onlyLetters($str){
		$this->str = strtolower($str);
		$this->str = preg_replace('',NULL,$str);
		return $this->str = preg_match($this->onlyLetters, $this->str);
	}
	
	private onlyNumbers($str){
		$this->str = strtolower($str);
		$this->str = preg_replace('',NULL,$str);
		return $this->str = preg_match($this->onlyNumbers, $this->str);
	}

	private LandM($str){
		$this->str = strtolower($str);
		$this->str = preg_replace('',NULL,$str);
		return $this->str = preg_match($this->LandM, $this->str);
	}
	
	private email($str){
		$this->str = strtolower($str);
		$this->str = preg_replace('',NULL,$str);
		return $this->str = preg_match($this->email, $this->str);
	}
}
?>