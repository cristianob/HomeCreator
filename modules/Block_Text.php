<?php
class Block_Text implements HC_Element, HC_Container_Element {
	var $container;
	var $background_color = "#FFFFFF";
	var $padding = "0";
	var $margin = "0";
	var $border = "none";
	var $width = "100%";
	var $text_align = "left";
	
	public function set_inner_element($container) {
		$this->container = $container;
	}

	public function get_html() {
		$style = "background-color:{$this->background_color};width:{$this->width};text-align:{$this->text_align};";
		if($this->margin != "0")
			$style .= "margin:{$this->margin};";
		
		$html = "<div id=\"block_text_container\" style=\"{$style}\">\n";
		if($this->container != NULL)
			$html .= $this->container->get_html();
		$html .= "</div>";

		return $html;
	}

	public function get_style() {
		$style = array();
		$style["#block_text_container"]["background-color"] = "#FFFFFF";
		$style["#block_text_container"]["border"] = $this->border;
		$style["#block_text_container"]["padding"] = $this->padding;

		$style["#block_text_container H1, #block_text_container H2, #block_text_container H3, #block_text_container H4"]["margin"] = "0px";
		$style["#block_text_container H1, #block_text_container H2, #block_text_container H3, #block_text_container H4"]["padding"] = "0px";
		
		if($this->container != NULL)
			$style = array_merge($style, $this->container->get_style());

		return $style;
	}

	public function get_script() {
		return $this->container->get_script();
	}
	
}
?>
