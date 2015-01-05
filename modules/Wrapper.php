<?php
class Wrapper implements HC_Element, HC_Container_Element {
	var $container;
	
	var $width = "800px";
	var $background_color = "#FFFFFF";
	var $border = "none";
	var $padding = "15px";
	
	
	public function set_inner_element($container) {
		$this->container = $container;
	}

	public function get_html() {
		$html = "<div class='wrapper'>\n";
		if($this->container != NULL)
			$html .= $this->container->get_html();
		$html .= "</div>";

		return $html;
	}

	public function get_style() {
		$style = array();
		$style[".wrapper"]["width"] = $this->width;
		
		if($this->background_color != "transparent")
			$style[".wrapper"]["background-color"] = $this->background_color;
			
		$style[".wrapper"]["border"] = $this->border;
		$style[".wrapper"]["margin-left"] = "auto";
		$style[".wrapper"]["margin-right"] = "auto";
		$style[".wrapper"]["margin-top"] = "0px";
		$style[".wrapper"]["padding"] = $this->padding;

		if($this->container != NULL)
			$style = array_merge($style, $this->container->get_style());

		return $style;
	}

	public function get_script() {
		return $this->container->get_script();
	}
	
}
?>
