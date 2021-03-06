<?php
class Google_Analytics extends HC_Element {
	var $id;
	
	public function __construct($id) {
		$this->id = $id;
	}

	public function get_html() {
		return "<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', '".$this->id."', 'auto');
  ga('require', 'displayfeatures');
  ga('send', 'pageview');

</script>";
	}

	public function get_style() { return array(); }

	public function get_script() { }
	
}
?>
