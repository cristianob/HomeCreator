<?php
class Header implements HC_Element, HC_Container_Element {
	const BACKGROUND_NONE = 0;

	var $logo;
	var $title;
	
	var $background_color = Header::BACKGROUND_NONE;
	var $title_color = "#eeeeee";
	var $height = "100px";
	var $width = "100%";
	var $wrapper_width = "1000px";
	
	var $menu = null;
	
	public function set_inner_element($menu) {
		$this->menu = $menu;
	}
	
	function get_html() {
		$html = "<header class=\"header\">\n";
		$html .= "<div class=\"header-wrapper\">\n";
		if($this->logo == "")
			$html .= "<h1><a href=\"http://". $_SERVER["SERVER_NAME"] ."\">" . $this->title . "</a></h1>";
		else
			$html .= "<h1><a href=\"http://". $_SERVER["SERVER_NAME"] ."\"><img src=\"". $this->logo ."\" alt=\"".$this->title."\" /></a></h1>";
			
		if($this->menu instanceof Menu) $html .= $this->menu->get_html();
		
		$html .= "</div>";
		$html .= "</header>";

		return $html;
	}

	function get_style() {
		$style = array();
		$style["HEADER.header"]["heigth"] = $this->height;
		$style["HEADER.header"]["width"] = $this->width;
		$style["HEADER.header"]["background-color"] = $this->background_color;
		
		$style["HEADER.header DIV.header-wrapper"]["margin-left"] = "auto";
		$style["HEADER.header DIV.header-wrapper"]["margin-right"] = "auto";
		$style["HEADER.header DIV.header-wrapper"]["width"] = $this->wrapper_width;
		$style["HEADER.header DIV.header-wrapper"]["height"] = "100%";
		$style["HEADER.header DIV.header-wrapper"]["display"] = "table";
		
		$style["HEADER.header A"]["display"] = "table-cell";
		$style["HEADER.header A"]["vertical-align"] = "middle";
		
		if($this->menu instanceof Menu) $style = array_merge_recursive($style, $this->menu->get_style());

		return $style;
	}

	function get_script(){}
}
?>
