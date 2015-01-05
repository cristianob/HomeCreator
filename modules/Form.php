<?php
class Form implements HC_Element, HC_Multi_Container_Element {
	var $elements = array();
	var $padding = "0 20px";
	var $name = "";
	var $action = "";
	var $method = "";
	var $send_label = "Send";
	
	public function add_element($element) {
		$this->elements[] = $element;
	}

	public function get_html() {
		$html = "<form id=\"{$this->name}\" action=\"{$this->action}\" method=\"{$this->method}\">\n";
		$html .= "<span class=\"form-msg\" id=\"{$this->name}_msg\"></span>";
		
		$i = 0;
		foreach($this->elements as $element) {
			if($element instanceof HC_Form_Item) {
				$element->set_form_name($this->name);
				$html .= $element->get_html();
			}
		}
		
		$html .= '<br /><input type="submit" value="'.$this->send_label.'" />';
		
		$html .= "</form>\n";

		return $html;
	}

	public function get_style() {
		$style = array();
		$style["FORM"]["display"] = "inline-block";
		$style["FORM"]["text-align"] = "left";
		
		for($i = 0; $i < sizeof($this->elements); $i++) {
			$style = array_merge($style, $this->elements[$i]->get_style());
		}
		
		return $style;
	}

	public function get_script() {
		return <<<EOF
function hc_sendform(form) {
	$.post( "form_rcv.php", $("#"+form).serialize() ) .done(function( data ) {
		if(data == "TRUE") {
			$("#"+form+"_msg").html("Mensagem foi enviada com sucesso<br />");
			$("#"+form+"_msg").css("color", "green");
			$("#"+form).trigger("reset");
		} else {
			$("#"+form+"_msg").html("Ocorreu um erro ao enviar a mensagem, tente novamente<br />");
			$("#"+form+"_msg").css("color", "red");
		}
	});
}
EOF;
	}
}

class HC_Form_Item implements HC_Element {
	var $form_name = "";
	
	public function set_form_name($name) {
		$this->form_name = $name;
	}
	
	public function get_html() {}
	public function get_style() {}
	public function get_script() {
	}
}
?>
