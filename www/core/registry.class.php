<?php
Class Registry Implements ArrayAccess{
    private $vars = array();

	public function __set($i, $value){
        if (isset($this->vars[$i]) == true) {
            throw new Exception($i . 'was already defined.');
        }
	$this->vars[$i] = $value;
    return true;
	}

	public function __get($i) {
		if (isset($this->vars[$i]) == false) {
			return null;
		}
	return $this->vars[$i];
	}
	
	function offsetExists($offset) {
		return isset($this->vars[$offset]);
	}

	function offsetGet($offset) {
		return $this->__get($offset);
	}

	function offsetSet($offset, $value) {
		$this->__set($offset, $value);
	}

	function offsetUnset($offset) {
		unset($this->vars[$offset]);
	}
}
?>