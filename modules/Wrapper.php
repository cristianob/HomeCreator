<?php
class Wrapper extends HC_Container_Element {
	var $width = "800px";
	var $background_color = "#FFFFFF";
	var $border = "none";
	var $padding = "15px";

	public function get_html() {
		$html = "<div class='wrapper'>\n";
		if($this->element != NULL)
			$html .= $this->element->get_html();
		$html .= "</div>";

		return $html;
	}

	public function get_style() {
		$style = array();
		$style[".wrapper"]["max-width"] = $this->width;
		$style[".wrapper"]["width"] = "100%";
		
		if($this->background_color != "transparent")
			$style[".wrapper"]["background-color"] = $this->background_color;
			
		$style[".wrapper"]["border"] = $this->border;
		$style[".wrapper"]["margin-left"] = "auto";
		$style[".wrapper"]["margin-right"] = "auto";
		$style[".wrapper"]["margin-top"] = "0px";
		$style[".wrapper"]["padding"] = $this->padding;

		if($this->element != NULL)
			$style = array_merge($style, $this->element->get_style());

		return $style;
	}

	public function get_script() {
		return $this->element->get_script();
	}
	
}
?>
