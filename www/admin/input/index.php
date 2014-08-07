<?php
Class Input_Index Extends Input_Base {

	function index()
	{
		$this->registry['output']->__set('submenu', '');
        $this->registry['output']->__show('/main/index');
	}
}
?>