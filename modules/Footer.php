<?php
class Footer implements HC_Element, HC_Container_Element {
	var $container;
	
	var $width = "100%";
	var $background_color = "#000000";
	var $border = "none";
	var $padding = "15px 0";
	var $wrapper_width = "1000px";
	
	
	public function set_inner_element($container) {
		$this->container = $container;
	}

	public function get_html() {
		$html = "<footer class=\"footer\">\n";
		$html .= "<div class=\"footer-wrapper\">\n";
		if($this->container != NULL)
			$html .= $this->container->get_html();
		$html .= "</div>";
		$html .= "</footer>";

		return $html;
	}

	public function get_style() {
		$style = array();
		$style["FOOTER.footer"]["width"] = $this->width;
		
		if($this->background_color != "transparent")
			$style["FOOTER.footer"]["background-color"] = $this->background_color;
			
		$style["FOOTER.footer"]["border"] = $this->border;
		$style["FOOTER.footer"]["margin-left"] = "auto";
		$style["FOOTER.footer"]["margin-right"] = "auto";
		$style["FOOTER.footer"]["margin-top"] = "0px";
		$style["FOOTER.footer"]["padding"] = $this->padding;

		$style["FOOTER.footer DIV.footer-wrapper"]["margin-left"] = "auto";
		$style["FOOTER.footer DIV.footer-wrapper"]["margin-right"] = "auto";
		$style["FOOTER.footer DIV.footer-wrapper"]["width"] = $this->wrapper_width;
		$style["FOOTER.footer DIV.footer-wrapper"]["height"] = "100%";
		$style["FOOTER.footer DIV.footer-wrapper"]["display"] = "table";
		
		if($this->container != NULL)
			$style = array_merge($style, $this->container->get_style());

		return $style;
	}

	public function get_script() {
		return $this->container->get_script();
	}
	
}
?>
