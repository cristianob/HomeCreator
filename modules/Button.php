<?
class Button implements HC_Element, HC_Text_Element {
	var $text;
	var $size;
	var $align;
	var $weight;
	var $padding;
	var $line_height;
	var $color;
	var $margin;
	
	var $background_color;
	var $width;
	var $height;
	var $border;
	
	var $href;
	var $title;
	
	public function set_text($text) {
		$this->text = $text;
	}
	
	public function get_html() {
		$style = "";
		
		if($this->size != "")
			$style .= "font-size: " . $this->size . ";";
		if($this->align != "")
			$style .= "text-align: " . $this->align . ";";
		if($this->weight != "")
			$style .= "font-weight: " . $this->weight . ";";
		if($this->padding != "")
			$style .= "padding: " . $this->padding . ";";
		if($this->margin != "")
			$style .= "margin: " . $this->margin . ";";
		if($this->line_height != "")
			$style .= "line-height: " . $this->line_height . ";";
		if($this->color != "")
			$style .= "color: " . $this->color . ";";
		
		if($this->background_color != "")
			$style .= "background-color: " . $this->background_color . ";";
		if($this->width != "")
			$style .= "width: " . $this->width . ";";
		if($this->height != "")
			$style .= "height: " . $this->height . ";";
		if($this->border != "")
			$style .= "border: " . $this->border . ";";
			
		$style .= "cursor:pointer;display:inline-block;";
		
		$html = "";
		
		$html .= "<div class=\"button\" style=\"$style\" onclick=\"document.location='{$this->href}'\">";	
		$html .= $this->process_text();
		
		if($style != "")
			$html .= "</div>";
		
		return $html;
	}
	
	private function process_text() {
		$this->text = UTF8_decode($this->text);
		$this->text = htmlentities($this->text);
		$this->text = str_replace("&quot;", "\"", $this->text);
		$this->text = str_replace("\\n", "<br />", $this->text);
	
		$patterns = array("/====(.*?)====/",
				  "/===(.*?)===/", 
				  "/==(.*?)==/", 
				  "/=(.*?)=/", 
				  '/image:\b(?:(http(s?):\/\/)|(?=www\.))(\S+)/is', 
				  '/\\[center\\][\\n]?/',
				  '/\\[\\/center\\][\\n]?/',
				  '/\\[bold\\][\\n]?/',
				  '/\\[\\/bold\\][\\n]?/',
				  '/\\[justify\\][\\n]?/',
				  '/\\[\\/justify\\][\\n]?/',
				  '/\\[left\\][\\n]?/',
				  '/\\[\\/left\\][\\n]?/',
				  '/\\[link (.*?) (.*?) bold\\][\\n]?/',
				  '/\\[link (.*?) (.*?)\\][\\n]?/',
				  '/\\[link (.*?)\\][\\n]?/',
				  '/\\[\\/link\\][\\n]?/',
				  '/\\[color (.*?)\\][\\n]?/',
				  '/\\[\\/color\\][\\n]?/',
				  '/([\s\n\t])\b(?:(http(s?):\/\/)|(?=www\.))(\S+)\:(\S+)/is',
				  '/([\s\n\t])\b(?:(http(s?):\/\/)|(?=www\.))(\S+)([\s\n\t])/is');

		$replaces = array("<h5>\\1</h5>",
				  "<h4>\\1</h4>",
				  "<h3>\\1</h3>",
				  "<h2>\\1</h2>",
				  '<img src="http$2://$3" />', 
				  '<div style="text-align: center; width: 100%">',
				  '</div>',
				  '<span style="font-weight: bold; width: 100%">',
				  '</span>',
				  '<div style="text-align: justify; width: 100%">',
				  '</div>',
				  '<div style="text-align: left; width: 100%">',
				  '</div>',
				  '<a href="\\1" style="color: \\2; font-weight: bold; text-decoration: none;">',
				  '<a href="\\1" style="color: \\2">',
				  '<a href="\\1">',
				  '</a>',
				  '<span style="color: \\1">',
				  '</span>',
				  '$1<a href="http$3://$4" target="_blank">$5</a>',
				  '$1<a href="http$3://$4" target="_blank">$2$4</a>$5');
				  
		$this->text = preg_replace($patterns, $replaces, $this->text);
		$this->text = nl2br($this->text);
		return $this->text;
	}

	public function get_style() {
		$style = array();
		$style[".button"]["text-decoration"] = "none";
		
		return $style;
	}

	public function get_script() {}
}
?>
