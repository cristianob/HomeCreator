<?php
class Image extends HC_Element {
	var $src;
	var $title;
	var $href;
	var $margin;
	var $crop_height;
	var $crop_box = false;
	var $uncrop_height;
	var $background_position;
	
	public function get_html() {
		$html = "";
		
		if($this->margin != "")
			$html .= "<div style=\"margin:{$this->margin}\">";
		
		if($this->href != "")
			$html .= "<a href=\"{$this->href}\">";
			
		if($this->crop_height != "") {
			$style = "";
			//if($this->background_position != "")
			//	$style .= "background-repeat:no-repeat;background-attachment:fixed;background-position:{$this->background_position};";
				
			if($this->crop_box) 
				$style .= "box-shadow: inset 0px 0px 50px 0px rgba(0,0,0,0.8);cursor:pointer;";
			
			$html .= "<div style=\"height:{$this->crop_height};overflow:hidden;background-image:url('{$this->src}');$style\"";
			
			if($this->crop_box)
				$html .= " onclick=\"box_crop(this)\"";
			
			$html .= "></div>";
		}
		else
			$html .= "<img src=\"{$this->src}\" title=\"{$this->title}\" />";
		
		if($this->href != "")
			$html .= "</a>";
			
		if($this->margin != "")
			$html .= "</div>";
			
		return $html;
	}

	public function get_style() { return array(); }

	public function get_script() {
		if($this->crop_box) {
			return <<<EOF
box_opened = false;
function box_crop(item) {
	if(!box_opened) {
		$(item).animate({height: "{$this->uncrop_height}"},400, 'linear');
		box_opened = true;
	} else {
		$(item).animate({height: "{$this->crop_height}"},400, 'linear');
		box_opened = false;
	}
}		
EOF;
		}
	}
}
?>
