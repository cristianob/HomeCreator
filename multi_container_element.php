<?php
require_once "element.php";

class HC_Multi_Container_Element extends HC_Element {
	public $elements = array();
	
	function add_element($element) {
		$this->elements[] = $element;
	}
	
	function get_elements() {
		return $this->elements;
	}
}
?>
