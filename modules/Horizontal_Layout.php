<?php
class Horizontal_Layout implements HC_Element, HC_Multi_Container_Element {
	var $items = array();
	var $align = array();
	var $heights = array();
	var $height = "";
	var $paddings = array();

	public function add_element($slider_item) {
		$this->items[] = $slider_item;
	}
	
	public function set_height($row, $height) {
		$this->heights[$row - 1] = $height;
	}
	
	public function set_align($row, $align) {
		$this->align[$row - 1] = $align;
	}

	public function get_html() {
		if(is_string($this->align))
			$this->align = explode(";", $this->align);
		if(is_string($this->heights))
			$this->heights = explode(";", $this->heights);
		if(is_string($this->paddings))
			$this->paddings = explode(";", $this->paddings);
			
		$html = "<div class='horizontal_slide_container' ";
		if($this->height != "")
			$html .= "style=\"height:{$this->height}\"";
		$html .= ">\n";

		$first_item = true;
		$i = 0;
		
		$total_set_height = 0;
		foreach($this->heights as $h)
			$total_set_height += $h;
		
		foreach($this->items as $item) {
			if(array_key_exists($i, $this->heights))
				$height = $this->heights[$i];
			else
				$height = floor(100 / (sizeof($this->items) - $total_set_height));
				
			if(array_key_exists($i, $this->align))
				$align = $this->align[$i];
			else
				$align = "left";
				
			if(array_key_exists($i, $this->paddings))
				$padding = $this->paddings[$i];
			else
				$padding = "0";
			
			if($i+1 == sizeof($this->items))
				$html .= '<div class="horizontal_slide_item" style="height: ' . $height . '%; border-right: none; text-align: ' . $align . '; padding: ' . $padding . ';">'. $item->get_html() ."</div>\n";
			else
				$html .= '<div class="horizontal_slide_item" style="height: ' . $height . '%; text-align: ' . $align . '; padding: ' . $padding . ';">'. $item->get_html() ."</div>\n";
				
			$i++;
		}

		$html .= "</div>";

		return $html;
	}

	public function get_style() {
		$style = array();
		$style[".horizontal_slide_container"]["width"] = "100%";
		$style[".horizontal_slide_container"]["height"] = "100%";
		$style[".horizontal_slide_container"]["display"] = "table";
		
		$style[".horizontal_slide_item"]["display"] = "table-row";
		$style[".horizontal_slide_item"]["width"] = "100%";
		$style[".horizontal_slide_item"]["border-right"] = "1px solid silver";

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
		
		return $script;
	}
}
?>
