<?
class Text extends HC_Text_Element {
	var $size;
	var $align;
	var $weight;
	var $padding;
	var $line_height;
	var $color;
	
	public function __construct($text = "") {
		$this->set_text($text);
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
		if($this->line_height != "")
			$style .= "line-height: " . $this->line_height . ";";
		if($this->color != "")
			$style .= "color: " . $this->color . ";";
		
		$html = "";
		
		if($style != "")	
			$html .= '<div style="'. $style .'">';
			
		$html .= $this->process_text();
		
		if($style != "")
			$html .= "</div>";
		
		return $html;
	}
	
	private function process_text() {
		$this->text = UTF8_decode($this->text);
		$this->text = str_replace("&quot;", "\"", $this->text);
		$this->text = str_replace("\\n", "<br />", $this->text);
	
		$patterns = array(
				  '/=====(.*?)=====/',
				  '/====(.*?)====/',
				  '/===(.*?)===/',				  
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

		$replaces = array(
				  '<h4>$1</h4>',
				  '<h3>$1</h3>',
				  '<h2>$1</h2>',				  
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

	public function get_style() { return array(); }

	public function get_script() {}
}
?>
