<?
class Iframe extends HC_Element {
	var $src;
	var $style;
	
	public function __construct() {}
	
	public function get_html() {		
		return "<iframe src=\"" . $this->src . "\" style=\"" . $this->style . "\"></iframe>";
	}
	
	public function get_style() { return array(); }

	public function get_script() {}
}
?>
