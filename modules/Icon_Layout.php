<?php
class Icon_Layout implements HC_Element, HC_Multi_Container_Element {
	var $elements = array();
		
	var $border = "none";
	var $horizontal_aligns = array();
	var $vertical_aligns = array();
	var $padding = "0 10px 20px 0";
	var $margin = "0";
	
	public function add_element($element) {
		$this->elements[] = $element;
	}
	
	public function get_html() {
		if(is_string($this->horizontal_aligns))
			$this->horizontal_aligns = explode(";", $this->horizontal_aligns);
		
		if(is_string($this->vertical_aligns))
			$this->vertical_aligns = explode(";", $this->vertical_aligns);
		
		
		$html = "<div class='icon-layout-container'>\n";

		$first_item = true;
		$i = 0;
		foreach($this->elements as $item) {
			if(array_key_exists($i, $this->horizontal_aligns))
				$ha = "text-align: ".$this->horizontal_aligns[$i].";";
			else
				$ha = "";
				
			if(array_key_exists($i, $this->vertical_aligns))
				$va = "vertical-align: ".$this->vertical_aligns[$i].";";
			else
				$va = "";
			
			if($i+1 == sizeof($this->elements))
				$html .= '<div class="icon-layout-item" style="display: inline-block; border-right: none;' . $ha . $va . 'padding: '. $this->padding . ';margin: '. $this->margin .'">'. $item->get_html() ."</div>\n";
			else
				$html .= '<div class="icon-layout-item" style="display: inline-block; border-right: ' . $this->border . ';' . $ha . $va . 'padding: '. $this->padding . ';margin: '. $this->margin .'">'. $item->get_html() ."</div>\n";
				
			$i++;
		}

		$html .= "</div>";

		return $html;
	}

	public function get_style() {
		$style = array();
		$style[".icon-layout-container"]["width"] = "100%";
		$style[".icon-layout-container"]["height"] = "100%";
		$style[".icon-layout-container"]["display"] = "table";

		for($i = 0; $i < sizeof($this->elements); $i++) {
			$style = array_merge($style, $this->elements[$i]->get_style());
		}
		
		return $style;
	}

	public function get_script() {
		$script = "";
		
		for($i = 0; $i < sizeof($this->elements); $i++) {
			$script .= $this->elements[$i]->get_script();
		}
		
		return $script;
	}
}
?>
