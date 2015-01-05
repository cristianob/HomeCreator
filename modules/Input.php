<?php
class Input extends HC_Form_Item implements HC_Element {
	var $type = "text";
	var $label;
	var $label_br = true;
	var $br = true;
	var $id;

	function get_html() {
		$html =  '<label for="input_' . $this->form_name . '_' . $this->id .'">'. $this->label .'</label>';
		
		if($this->label_br)
			$html .= "<br />";
			
		$html .= '<input type="'.$this->type.'" name="input_' . $this->form_name . '_' . $this->id .'" id="input_' . $this->form_name . '_' . $this->id .'" />';
		
		if($this->br)
			$html .= "<br />";
			
		$html .= "\n";
		return $html;
	}
	
	function get_style() {
		$style["LABEL"]["width"] = "80px";
		$style["LABEL"]["display"] = "inline-block";
		$style["LABEL"]["text-align"] = "left";
		$style["LABEL"]["margin-right"] = "5px";
		$style["INPUT"]["margin-bottom"] = "5px";
	
		return $style;
	}
	
	function get_script(){}
}
?>