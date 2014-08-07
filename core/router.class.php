<?php
Class router{
	private $registry;
	private $path;
	private $args = array();

	public $input;
	public $action;
	public $file;

	public function __construct($registry){
		$this->registry = $registry;
	}

	public function setPath($path){
		if (is_dir($path) == false) {
			throw new Exception ('Invalid input path: `' . $path . '`');
		}
		$this->path = $path;
	}

	private function getinput(){
		$route = (empty($_GET['view'])) ? '' : $_GET['view'];
	
		if (empty($route)){
			$route = 'index';
		}

		$route = trim($route, '/\\');
		$parts = explode('/', $route);

		$path = $this->path;

		foreach ($parts as $part){
			if (is_file($path . '/' . $part . '.php')){
				$this->input = $part;
				array_shift($parts);
				break;
			}
		}

		if (empty($this->input)){
			$this->input = 'index';
		}

		$this->action = array_shift($parts);
		if(empty($this->action)){ 
			$this->action = 'index'; 
		}

		$this->file = $this->path . '/' . $this->input . '.php';
	}
	
	public function start(){
		$this->getinput();

		if (!is_readable($this->file)){
			die(include 'error/404.html');
		}
		include $this->file;

		$class = 'Input_' . $this->input; 
		$input = new $class($this->registry);

		if (!is_callable(array($input, $this->action))){
			die(include 'error/404.html');
		}else{
			$action = $this->action;
		}
		
		$input->$action();
	}
}
