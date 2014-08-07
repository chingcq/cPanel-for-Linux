<?php
Abstract Class Input_Base
{
	protected $registry;

	function __construct($registry)
	{
		$this->registry = $registry;
	}

	abstract function index();
}
?>