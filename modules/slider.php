<?php
require_once "hc_element.php";

class HC_Slider implements HC_Element {
	var $items = array();
	var $background_color = "transparent";
	
	function set_background_color($bg) {
		$this->background_color = $bg;
	}

	public function add_item($slider_item) {
		$this->items[] = $slider_item;
	}

	public function get_html() {
		$html = "<div id='slider_container'>\n";

		$first_item = true;
		$i = 0;
		foreach($this->items as $item) {
			$html .= '<div class="slider_item" id="slider_'.$i.'">'. $item->get_html() ."</div>\n";
			$i++;
		}

		$html .= "</div>";

		return $html;
	}

	public function get_style() {
		$style = array();
		$style["#slider_container"]["width"] = "100%";
		$style["#slider_container"]["height"] = "88%";
		$style["#slider_container"]["background-color"] = $this->background_color;
		$style[".slider_item"]["width"] = "100%";
		$style[".slider_item"]["height"] = "85%";
		$style[".slider_item"]["position"] = "absolute";

		for($i = 0; $i < sizeof($this->items); $i++) {
			$style = array_merge($style, $this->items[$i]->get_style());
		}
		
		return $style;
	}

	public function get_script() {
		$script = "";
				
		for($i = 0; $i < sizeof($this->items); $i++) {
			$script .= $this->items[$i]->get_script();
		}
		
		return '
var slider_actual = 0;
var slider_max = '.sizeof($this->items).';

function slider_change_to(item) {
	$("#menu_item_"+slider_actual).removeClass("menu_active");
	slider_actual = item;
	$("#menu_item_"+slider_actual).addClass("menu_active");
	slider_set_positions();
}

function slider_set_first_positions() {
	for(i = slider_max; i > 0; i--) {
		$("#slider_"+i).css("left", ((i - slider_actual) * ($(window).width() - 100))  + "px");
	}
}

function slider_set_positions() {
	for(i = 0; i < slider_max; i++) {
		$("#slider_"+i).animate({left: ((i - slider_actual) * ($(window).width() - 100))  + "px"}, 600);
	}
}

$("document").ready(function() {
	slider_set_first_positions();
});
		' . $script;
	}
}
?>
