<?php
Class Output{
	private $registry;
	private $vars = array();
	
	function __construct($registry)
	{
		$this->registry = $registry;
	}
	
	public function __set($i, $value)
	{
        if(isset($this->vars[$i]))
		{
            throw new Exception($i . 'was already defined.');
        }
		$this->vars[$i] = $value;
		return true;
	}
	
	public function __remove($i)
	{
		if(!isset($this->vars[$i]))
		{
            throw new Exception($i . 'is not defined.');
        }
		else
		{
			unset($this->vars[$i]);
			return true;
		}
	}
	
	public function __show($name)
	{
		$path = SRV_ROOT . '/output/' . $name . '.php';

		if(!file_exists($path))
		{
			throw new Exception($path . 'does not exist');
			return false;
		}

		// Load variables
		foreach($this->vars as $key => $value)
		{
			$$key = $value;
		}
		
		include(SRV_ROOT . 'template/template.php');
		return $path;               
	}
}