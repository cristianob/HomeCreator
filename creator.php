<?php
require_once "element.php";
require_once "text_element.php";
require_once "container_element.php";
require_once "multi_container_element.php";

function hc_autoload ($pClassName) {
	include(__DIR__ . "/modules/" . $pClassName . ".php");
}
spl_autoload_register("hc_autoload");

class HC_Creator {
	const DOCTYPE_HTML5 = 1;
	const DOCTYPE_HTML401_STRICT = 2;
	const DOCTYPE_HTML401_TRANSACTIONAL = 3;
	const DOCTYPE_HTML401_FRAMESET = 4;
	const DOCTYPE_XHTML1_STRICT = 5;
	const DOCTYPE_XHTML1_TRANSACTIONAL = 6;
	const DOCTYPE_XHTML1_FRAMESET = 7;
	const DOCTYPE_XHTML11 = 8;

	var $elements = array();
	var $style = array();
	var $script = "";
	
	var $external_styles = array();
	var $external_scripts = array();

	var $doctype = HC_Creator::DOCTYPE_HTML5;
	var $language = "en_US";
	var $title;
	var $charset = "";
	var $keywords = "";
	var $description = "";
	var $author = "";

	var $background;
	var $font = "Tahoma, sans-serif";
	var $color = "#111111";

	public function __construct() {
		$this->set_style_defaults();	
	}
	
	public function include_modules(array $modules) {
		
	}

	public function add_element($element) {
		$this->elements[] = $element;
	}

	public function set_doctype($doctype) {
		$this->doctype = $doctype;
	}

	public function set_language($language) {
		$this->language = $language;
	}
	
	public function set_title($title) {
		$this->title = $title;
	}

	public function set_charset($charset) {
		$this->charset = $charset;
	}

	public function set_keywords($keywords) {
		$this->keywords = $keywords;
	}

	public function set_description($description) {
		$this->description = $description;
	}

	public function set_author($author) {
		$this->author = $author;
	}
	
	public function set_font($font) {
		$this->font = $font;
	}

	public function set_color($color) {
		$this->color = $color;
	}

	public function set_forced_css($element, $prop, $value) {
		$this->style[$element][$prop] = $value;
	}
	
	public function add_external_style($style) {
		$this->external_styles[] = $style;
	}
	
	public function add_external_script($script) {
		$this->external_scripts[] = $script;
	}
	
	public function set_background_color($color) {
		$this->style["HTML, BODY"]["background"] = $color;
	}

	public function set_background_image($url) {
		$this->style["HTML, BODY"]["background-image"] = 'url("' . $url . '")';
	}

	public function create_page() {
		$this->set_styles();
		
		//Doctype
		echo $this->html_get_doctype() . "\n";

		//Html Tag
		echo "<html lang=\"". $this->language ."\" xmlns=\"http://www.w3.org/1999/xhtml\">\n";

		echo "<head>\n";
		
		echo "<title>" . $this->title . "</title>\n";

		//Meta tags
		echo "<meta http-equiv=\"Content-Type\" content=\"" . $this->html_get_charset() . "\" />\n";
		if($this->keywords != "") 	 echo '<meta name="keywords" content="' . $this->keywords . '" />'."\n";
		if($this->description != "") echo '<meta name="description" content="' . $this->description . '" />'."\n";
		if($this->author != "") 	 echo '<meta name="author" content="' . $this->author . '" />'."\n";
		echo '<meta name="generator" content="HomeCreator 0.1alpha" />'."\n";
		echo '<meta name="viewport" content="width=1250px, user-scalable=yes" />';
		echo '<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />';
		
		//External css's
		foreach($this->external_styles as $s)
			echo '<link href="'. $s .'" rel="stylesheet" type="text/css" />'."\n";
		
		echo '<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>' . "\n";
		foreach($this->external_scripts as $s)
			echo "<script src=\"$s\"></script>\n";

		echo "<style type=\"text/css\">\n" . $this->html_generate_style() . "</style>\n";

		$this->html_generate_script();
		echo "<script>\n" . $this->script . "</script>\n";

		echo "</head>\n<body>\n";

		for($i = 0; $i < sizeof($this->elements); $i++) {
			echo $this->elements[$i]->get_html();
		}

		echo "\n</body>\n</html>";
	}

	protected function set_style_defaults() {
		$this->style["HTML, BODY"]["width"] = "100%";
		$this->style["HTML, BODY"]["height"] = "100%";
		$this->style["HTML, BODY"]["padding"] = "0";
		$this->style["HTML, BODY"]["margin"]  = "0";
		$this->style["HTML, BODY"]["font-size"] = "1em";
		$this->style["HTML, BODY"]["background-color"] = "#EEEEEE";
		$this->style["H2, H3"]["margin"] = "15px 0px";
	}
	
	protected function set_styles() {
		$this->style["HTML, BODY"]["font-family"] = $this->font;
		$this->style["HTML, BODY"]["color"] = $this->color;
	}

	private function html_generate_style() {
		for($i = 0; $i < sizeof($this->elements); $i++) {
			$this->style = array_merge($this->style, $this->elements[$i]->get_style());
		}

		$html = "";
		foreach($this->style as $tag => $s) {
			$html .= $tag . " {\n";
			foreach($s as $prop => $value) {
				$html .= "\t" . $prop . ": " . $value . ";\n";
			}
			$html .= "}\n\n";
		}

		return $html;
	}

	private function html_generate_script() {
		for($i = 0; $i < sizeof($this->elements); $i++) {
			if($this->elements[$i]->get_script() != "") {
				$this->script .= $this->elements[$i]->get_script() . "\n\n";
			}
		}
	}

	protected function html_get_doctype() {
		switch($this->doctype) {
			case HC_Creator::DOCTYPE_HTML5:
				return "<!DOCTYPE html>";
				break;

			case HC_Creator::DOCTYPE_HTML401_STRICT:
				return '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">';
				break;

			case HC_Creator::DOCTYPE_HTML401_TRANSACTIONAL:
				return '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">';
				break;

			case HC_Creator::DOCTYPE_HTML401_FRAMESET:
				return '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">';
				break;

			case HC_Creator::DOCTYPE_XHTML1_STRICT:
				return '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">';
				break;

			case HC_Creator::DOCTYPE_XHTML1_TRANSACTIONAL:
				return '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
				break;

			case HC_Creator::DOCTYPE_XHTML1_FRAMESET:
				return '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">';
				break;

			case HC_Creator::DOCTYPE_XHTML11:
				return '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">';
				break;
		}

	}

	protected function html_get_charset() {
		if($this->charset == "") {
			if($this->doctype == HC_CREATOR::DOCTYPE_HTML5)
				return "UTF-8";
			else
				return "ISO-8859-1";
		}

		return $this->charset;
	}
}

?>
