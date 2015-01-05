<?php
class Menu implements HC_Element, HC_Multi_Container_Element {
	var $elements = array();
	
	var $color = "#eeeeee";
	var $selected_color = "#eeeeee";
	var $font_size = "15pt";
	var $font_family = "Arial";
	var $line_color = "#eeeeee";

	public function add_element($menu_item) {
		if($menu_item instanceof Menu_Item) {
			$this->elements[] = $menu_item;
		}
	}

	public function get_html() {
		$html = "<nav class=\"menu-top\">\n";
		$html .= "<ul>\n";

		foreach($this->elements as $element)
			$html .= "<li>" . $element->get_html() . "</li>";

		$html .= "</ul>";
		$html .= "</nav>";

		return $html;
	}

	public function get_style() {
		$style = array();
		$style["NAV.menu-top"]["display"] = "table-cell";
		$style["NAV.menu-top"]["vertical-align"] = "middle";
		$style["NAV.menu-top"]["text-align"] = "right";
		
		$style["NAV.menu-top ul"]["color"] = "#eeeeee";
		$style["NAV.menu-top ul"]["list-style"] = "none";
		
		$style["NAV.menu-top li"]["display"] = "inline";
		$style["NAV.menu-top li"]["font-size"] = "20px";
		$style["NAV.menu-top li"]["margin-right"] = "10px";
		$style["NAV.menu-top li"]["height"] = "500px";
		$style["NAV.menu-top li"]["padding"] = "10px 0";
		
		$style["NAV.menu-top ul li+li"]["border-left"] = "solid 2px {$this->line_color}";
		$style["NAV.menu-top ul li+li"]["padding-left"] = "15px";
		
		$style["NAV.menu-top ul li a"]["color"] = $this->color;
		$style["NAV.menu-top ul li a"]["font-family"] = $this->font_family;
		$style["NAV.menu-top ul li a"]["font-size"] = $this->font_size;
		$style["NAV.menu-top ul li a"]["line-height"] = $this->font_size;
		$style["NAV.menu-top ul li a"]["text-decoration"] = "none";
		
		$style["NAV.menu-top ul li a:hover"]["font-weight"] = "bold";
		$style["NAV.menu-top ul li a:hover"]["color"] = $this->selected_color;

		return $style;
	}

	public function get_script(){}
}
?>
