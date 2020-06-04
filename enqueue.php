<?php
/*===========================================
		Admin Scripts
=============================================*/

function load_admin_scripts($hook) {
	echo $hook;
	if($hook==='toplevel_page_blog_admin'|| 'admin_page_theme_support'){
		wp_enqueue_media();
		wp_enqueue_style( 'admin_css', get_template_directory_uri() . '/css/blog_admin.css', array(), '3.3.7', 'all' );
		wp_enqueue_script('admin_js',get_template_directory_uri(). '/js/blog_jquery.js',array(),'3.3.7',true);
		wp_enqueue_script('customjquery',get_template_directory_uri(). '/js/jquery-3.2.1.min.js',array(),'3.2.1',true);
		wp_enqueue_style( 'fonts_admin', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '3.3.7', 'all' );
	}
}
add_action('admin_enqueue_scripts','load_admin_scripts');

/*===========================================
		Public Scripts
=============================================*/
function load_public_scripts(){
	/* Javascript */
	wp_enqueue_script('customjquery',get_template_directory_uri(). '/js/jquery-3.2.1.min.js',array(),'3.2.1',true);
	wp_enqueue_script('bootstrap_js',get_template_directory_uri(). '/js/bootstrap.min.js',array(),'3.2.1',true);
	wp_enqueue_script('custom_js',get_template_directory_uri(). '/js/public_js.js',array(),'1.0.0',true);
	wp_enqueue_script('captcha','https://www.google.com/recaptcha/api.js',array(),'1.0.0',false);

	/* Stylesheet */
	wp_enqueue_style( 'fonts_public', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '3.3.7', 'all' );
	wp_enqueue_style('bootstrap_css',get_template_directory_uri().'/css/bootstrap.min.css',array(),'3.3.7','all');
	wp_enqueue_style('custom_css',get_template_directory_uri().'/css/css.css',array(),'1.0.0','all');
	wp_enqueue_style('custom_media',get_template_directory_uri().'/css/media.css',array(),'1.0.0','all');
	wp_enqueue_style('wordpress_css',get_template_directory_uri().'/css/wordpress.css',array(),'1.0.0','all');
}
add_action('wp_enqueue_scripts','load_public_scripts');

function load_google_fonts(){
	wp_enqueue_style( 'raleway', 'https://fonts.googleapis.com/css?family=Raleway:200,300,400,500',array(),'1.0.0','all' );
	wp_enqueue_style('montserrat','https://fonts.googleapis.com/css?family=Montserrat:300,400',array(),'1.0.0','all');
	wp_enqueue_style('proze&libre','https://fonts.googleapis.com/css?family=Lato',array(),'1.0.0','all');
}
add_action('wp_print_styles','load_google_fonts');
?>