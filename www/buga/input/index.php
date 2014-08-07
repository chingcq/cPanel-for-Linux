<?php
Class Input_Index Extends Input_Base {

	function index()
	{


/**
	
	$data = array(
			array(15, "UK"),
			array(10, "Germany"),
			array(50, "Sweden"),
			array(80, "France"),
			array(10, "Africa"),
			array(5, "Russia"),
			array(20, "Ukraine")
			);
			
				$pie = new pie_chart($registry);
	$this->registry->__set('pie', $pie);
    $this->registry['pie']->Draw($data);
	/*
	$values=array(
			array(15, "UK"),
			array(10, "Germany"),
			array(50, "Sweden"),
			array(80, "France"),
			array(10, "Africa"),
			array(5, "Russia"),
			array(20, "Ukraine")
			);
	$values=array(
			array(15, "Monday"),
			array(10, "Tuesday"),
			array(50, "Wednesday"),
			array(80, "Thursday"),
			array(10, "Friday"),
			array(5, "Saturday"),
			array(20, "Sunday")
			);

 	$bar = new bar_graph($registry);
	$this->registry->__set('bar', $bar);
    $this->registry['bar']->Draw($values);

 	$bar = new pred_graph($registry);
	$this->registry->__set('pred_graph', $bar);
    $this->registry['pred_graph']->Draw($values);
    */
        $this->registry['output']->__set ('message', 'HELLO WORLD!');
		$this->registry['output']->__set('submenu', '');
        $this->registry['output']->__show('/main/index');

  	}
}
?>