<?php
class Textarea extends HC_Form_Item implements HC_Element {
	var $label;
	var $id;
	var $width = "320px";
	var $height = "150px";

	function get_html() {
		$html =  '<label for="input_' . $this->form_name . '_' . $this->id .'">'. $this->label .'</label><br />';
		$html .= '<textarea name="input_' . $this->form_name . '_' . $this->id .'" id="input_' . $this->form_name . '_' . $this->id .'" / style="width:'.$this->width.';height:'.$this->height.'"></textarea>'."\n";
		return $html;
	}
	
	function get_style() {
		return array();
	}
	
	function get_script(){}
}
?>