<?
class Script extends HC_Text_Element {
	var $text;
	
	public function __construct($text = "") {
		$this->set_text($text);
	}
	
	public function set_text($text) {
		$this->text = $text;
	}

	public function get_html() {
		return "<script>".$this->text."</script>";
	}

	public function get_style() { return array(); }

	public function get_script() { }
}
?>
