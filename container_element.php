<?php
require_once "element.php";

class HC_Container_Element extends HC_Element {
	public $element = false;
	
	function set_inner_element($element) {
		$this->element = $element;
	}
	
	function get_inner_element() {
		return $this->element;
	}
}
?>
