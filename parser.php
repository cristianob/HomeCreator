<?php
class HC_Parser {
	private $file;
	
	public function __construct($file) {
		$this->file = $file;
	}
	
	public function parse() {
		$xml = simplexml_load_file($this->file);
		
		$main_elements = array();
		
		foreach($xml as $children) {
			$element = $children->getName();
			$element = new $element;
			
			$attributes = (array) $children->attributes();
			if(array_key_exists("@attributes", $attributes)) {
				$attributes = $attributes['@attributes'];
				foreach($attributes as $name => $value)
					if(property_exists($element, $name))
						$element->{$name} = $value;
			}
			
			if($children->count() > 0) {
				if($element instanceof HC_Container_Element)
					$this->_parse_child($children, $element, true);
				elseif($element instanceof HC_Multi_Container_Element)
					$this->_parse_child($children, $element, false);	
			} elseif($element instanceof HC_Text_Element)
				$element->set_text($children->__toString());
			
			$main_elements[] = $element;
		}
		
		return $main_elements;
	}
	
	public function _parse_child($xml, $parent, $single = true) {
		foreach($xml as $children) {
			$element = $children->getName();
			$element = new $element;
			
			$attributes = (array) $children->attributes();
			if(array_key_exists("@attributes", $attributes)) {
				$attributes = $attributes['@attributes'];
				foreach($attributes as $name => $value)
					if(property_exists($element, $name))
						$element->{$name} = $value;
			}
			
			if($children->count() > 0) {
				if($element instanceof HC_Container_Element)
					$this->_parse_child($children, $element, true);
				elseif($element instanceof HC_Multi_Container_Element)
					$this->_parse_child($children, $element, false);
			} elseif($element instanceof HC_Text_Element){
				$element->set_text($children->__toString());
			}
			
			if($single)	$parent->set_inner_element($element);
			else	    	$parent->add_element($element); 
		}
	}
}
?>
