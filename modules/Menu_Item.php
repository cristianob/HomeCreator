<?php
class Menu_Item extends HC_Element {
	var $label;
	var $href;
	var $title;
	
	public function get_html() {
		return "<a href=\"{$this->href}\" title=\"{$this->title}\">{$this->label}</a>";
	}
	
	public function get_style(){}
	public function get_script(){}
}
?>
