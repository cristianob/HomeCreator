<?
require_once "hc_element.php";

class HC_HTML implements HC_Element {
	var $text;
	
	public function __construct($text) {
		$this->text = $text;
	}
	

	public function get_html() {
		return $this->text;
	}

	public function get_style() { return array(); }

	public function get_script() {}
}
?>
