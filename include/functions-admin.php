<?php
/* Admin Functions
----------------------------------------------*/

function blog_activate_admin_page(){

	//Admin Page
	add_menu_page('Blog Admin','Blog admin','manage_options','blog_admin','blog_load_admin_page','dashicons-admin-generic',110);

	//General Options Page
	add_submenu_page('blog_admin','general_settings','General','manage_options','blog_admin','blog_load_admin_page');

	//Theme Support Page
	add_submenu_page('blog_admin','theme_support','Theme Support','manage_options','theme_support','blog_theme_support');

	//Custom CSS Page
	add_submenu_page('blog_admin','custom_css','Custom CSS','manage_options','custom_css','blog_custom_css');

	//Custom settings
	add_action('admin_init','blog_custom_settings');
}
add_action('admin_menu','blog_activate_admin_page');


/*  Custom Settings
-----------------------------------------------*/
function blog_custom_settings(){
//	General Options
	register_setting('blog_general_settings','first_name','sanitize_handler');
	register_setting('blog_general_settings','last_name','sanitize_handler');
	register_setting('blog_general_settings','author_picture');
	register_setting('blog_general_settings','facebook_handler','sanitize_handler');
	register_setting('blog_general_settings','twitter_handler','sanitize_handler');
	register_setting('blog_general_settings','google_handler','sanitize_handler');

	add_settings_section('general_section','','','blog_admin');
	add_settings_field('profile_picture','Author Picture:','author_picture','blog_admin','general_section');
	add_settings_field('first_name_id','Full Name:','author_name','blog_admin','general_section');
	add_settings_field('fb_handler_id','Facebook handler:','facebook_handler','blog_admin','general_section');
	add_settings_field('twitter_name_id','Twitter handler:','twitter_handler','blog_admin','general_section');
	add_settings_field('google_name_id','Google handler:','google_handler','blog_admin','general_section');

//	Theme Support
	register_setting('blog_theme_support','activate_comments');
	register_setting('blog_theme_support','activate_contact_form');
	register_setting('blog_theme_support','view_counts');
	register_setting('blog_theme_support','display_post_thumbnail');
	add_settings_section('theme_support_section_id','<h4>Activate/Deactivate specific theme options</h4>','','theme_support');
	add_settings_field('theme_support_field_id','Activate Comments :','activate_comments','theme_support','theme_support_section_id');
	add_settings_field('theme_view_id','Show Views Count :','view_counts','theme_support','theme_support_section_id');
	add_settings_field('display_post_thumbnail_id','Show thumbnail in single blog post','display_post_thumbnail','theme_support','theme_support_section_id');

//  Theme Support Form Section
	add_settings_section('theme_form_section_id','','contact_description','theme_support');
	//add_settings_field('theme_form_field_id','Activate Contact Form','contact_form','theme_support','theme_form_section_id');

//	Custom CSS
	register_setting('blog_custom_css','custom_css','sanitize_handler');
	add_settings_section('custom_css_section_id','<h4>Insert your Custom CSS</h4>','','custom_css');
	add_settings_field('custom_css_field_id','Custom CSS:','insert_custom_css','custom_css','custom_css_section_id');

//  Teaser Post
	register_setting('blog_teaser_settings','teaser_image');
	add_settings_section('blog_teaser_id','','','teaser_post');
}

/*  General Section
------------------------------------------------*/
//Author Picture
function author_picture(){
	$picture=esc_attr(get_option('author_picture'));
	if(empty($picture)):
		echo "<input type='button' class='button' value='Upload' id='upload-button' data-url='".admin_url('admin-ajax.php')."'>".
		     "<input type='hidden' id='profile-picture' name='author_picture' value=''>".submit_button('Save Changes','primary','btnSubmit');
	else:
		echo "<input type='button' class='button' value='Replace Image' id='upload-button'>".
		     "<input type='button' class='button' value='Remove Picture' id='remove-button'>".
		     "<input type='hidden' id='profile-picture' name='author_picture' value='$picture'>".submit_button('Save Changes','primary','btnSubmit');
	endif;
}

function author_name(){
	$first_name=esc_attr(get_option('first_name'));
	$last_name=esc_attr(get_option('last_name'));
	$output="<input type='text' placeholder='First Name' name='first_name' value='".$first_name."'>";
	$output.="<input type='text' placeholder='Last Name' name='last_name' value='".$last_name."'>";
	echo $output;
}

function facebook_handler(){
	$facebook_handler=esc_attr(get_option('facebook_handler'));
	echo "<input type='text' placeholder='Facebook' name='facebook_handler' value='".$facebook_handler."'>
	<p class='description'>Please enter without @ symbol</p>";
}

function twitter_handler(){
	$twitter_handler=esc_attr(get_option('twitter_handler'));
	echo "<input type='text' placeholder='Twitter' name='twitter_handler' value='".$twitter_handler."'>
	<p class='description'>Please enter without @ symbol</p>";
}

function google_handler(){
	$google_handler=esc_attr(get_option('google_handler'));
	echo "<input type='text' placeholder='Google+' name='google_handler' value='".$google_handler."'>
	<p class='description'>Please enter without @ symbol</p>";
}

/*  Theme Support
------------------------------------------------*/
function activate_comments(){
	$activate_comments=esc_attr(get_option('activate_comments'));
	$checked=($activate_comments) ? 'checked' : '';
	echo "<input type='checkbox' name='activate_comments' value='1' ".$checked.">";
}
function view_counts(){
	$view_counts=esc_attr(get_option('view_counts'));
	$checked=($view_counts) ? 'checked' : '';
	echo "<input type='checkbox' name='view_counts' value='1' ".$checked.">";
}
function display_post_thumbnail(){
	$display=esc_attr(get_option('display_post_thumbnail'));
	$checked=($display) ? 'checked' : '';
	echo "<input type='checkbox' name='display_post_thumbnail' value='1' ".$checked.">";
}

/*  Custom CSS*/
function insert_custom_css(){
	$custom_css=esc_attr(get_option('custom_css'));
	$custom_css = (!$custom_css) ? '/* Blog theme CSS */' : $custom_css;
	echo "<textarea name='custom_css'>".$custom_css."</textarea>";
}
function contact_description(){
	echo "<p>Use this <strong>shortcode</strong> to activate the Contact Form Inside Post or Page</p>
    <p><code>[contact_form]</code></p>";
}
//function contact_form(){
//	$option=esc_attr(get_option('activate_contact_form'));
//	$option=($option) ? 'checked' : '';
//	echo "<input type='checkbox' placeholder='First Name' name='activate_contact_form' value='1' ".$option." >";
//}

/*  Sanitizing
----------------------------------------------*/
function sanitize_handler($input){
	$output=sanitize_text_field($input);
	$output=str_replace('@','',$output);
	return $output;
}

/*  Linking Admin Pages
----------------------------------------------*/
function blog_load_admin_page(){
	require_once get_template_directory().'/include/admin-templates/blog-admin.php';
}

function blog_theme_support(){
	require_once get_template_directory(). '/include/admin-templates/blog_theme_support.php';
}

function blog_custom_css(){
	require_once get_template_directory(). '/include/admin-templates/custom_css.php';
}
?>