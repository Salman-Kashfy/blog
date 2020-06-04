<?php
function sunset_contact($atts,$content=null){
	$atts= shortcode_atts(array(),$atts,'contact_form ');

	ob_start();
	require_once  get_template_directory().'/template_parts/contact_form.php';
	return ob_get_clean();
}
add_shortcode('contact_form','sunset_contact');
?>