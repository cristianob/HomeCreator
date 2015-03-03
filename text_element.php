<?php
class HC_Text_Element extends HC_Element {
	public $text;
	
	function set_text($text) {
		$this->text = $text;
	}	
	
	function get_text() {
		return $this->text;
	}
}
?>
