<?php

/*===========================================
		Menus Activation
=============================================*/
function blog_add_menus(){
	register_nav_menu('primary','Header Navigation');
}
add_action('init','blog_add_menus');

/*===========================================
		Sidebar Activation
=============================================*/

function random_sidebar(){

	$args = array(
		'name'          => 'Sidebar',
		'id'            => 'unique-sidebar-id',
		'description'   => 'Standard Sidebar',
		'class'         => 'sidebar',
		'before_widget' => '<div class="col-sm-6 col-md-12"><section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section></div>',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => '</h2>'

	);
	register_sidebar($args);
}
add_action( 'widgets_init', 'random_sidebar');

/*===========================================
		General Theme support
=============================================*/

add_theme_support('post-thumbnails');
add_theme_support('custom-header');

add_theme_support('post-formats',array('aside','video','audio',));

function sunset_get_post_navigation(){
	if( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ):
		require( get_template_directory() . '/include/blog_comments.php' ); /*Include file as stated from Alecaddd*/
	endif;
}

/*===========================================
		Video Function
=============================================*/

function sunset_get_embedded_media( $type = array() ){
	$content = do_shortcode( apply_filters( 'the_content', get_the_content() ) );
	$embed = get_media_embedded_in_content( $content, $type );
	$output = str_replace( '?visual=true', '?visual=false', $embed[0] );
	return $output;
}
function get_sunset_get_embedded_media( $type = array() ){
	preg_match('/src="([^"]+)"/', sunset_get_embedded_media( array('video','iframe') ), $array);
	 //$array= explode("src=",sunset_get_embedded_media( array('video','iframe') ));


	return $array['1'];

}

/*===========================================
		Grab url for Link Post Formats
=============================================*/
function grab_url() {
	if( ! preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/i', get_the_content(), $links ) ){
		return false;
	}
	return esc_url_raw( $links[1] );
}

/*==========================================
		Attachment Post Type
============================================*/

function sunset_get_attachment( $num = 1 ){

	$output = '';
	if( has_post_thumbnail() && $num == 1 ):
		$output = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
	else:
		$attachments = get_posts( array(
			'post_type' => 'attachment',
			'posts_per_page' => $num,
			'post_parent' => get_the_ID(),
			'post_mime_type' => 'image/jpeg,image/gif,image/jpg,image/png'
		) );
		if( $attachments && $num == 1 ):
			foreach ( $attachments as $attachment ):
				$output = wp_get_attachment_url( $attachment->ID );
			endforeach;
		elseif( $attachments && $num > 1 ):
			$output = $attachments;
		endif;

		wp_reset_postdata();

	endif;

	return $output;
}
/*==========================================
		 Get Category
============================================*/
function get_blog_category(){
	$categories=get_the_category();
	$output='';
	$i=0;
	if(!empty($categories)):
		foreach ($categories as $category):
			if($i>=1): $output.= ','; endif;
			$i++;
			$output.="<a class='blog_meta' href='".esc_url( get_category_link($category->term_id))."'alt='". esc_attr('View all post in%s',$category->name)."'>".esc_html($category->name)."</a>";
		endforeach;
	endif;
	return $output;
}

/*==========================================
		 Category Count Edit
============================================*/

function categories_postcount_filter ($variable) {
	$variable = str_replace('(', '<span class="post_count"> ', $variable);
	$variable = str_replace(')', ' </span>', $variable);
	return $variable;
}
add_filter('wp_list_categories','categories_postcount_filter');

/*==========================================
		 Localhost Mail Server Test
============================================*/

//
//function mailtrap($phpmailer) {
//	$phpmailer->isSMTP();
//	$phpmailer->Host = 'smtp.mailtrap.io';
//	$phpmailer->SMTPAuth = true;
//	$phpmailer->Port = 2525;
//	$phpmailer->Username = 'e7333861e46ef7';
//	$phpmailer->Password = '761e524498b878';
//}
//add_action('phpmailer_init', 'mailtrap');

/*==========================================
		 Display Post View at Index.php
============================================*/

function index_meta(){
	$date=get_the_date();
    if(get_option('view_counts')){
	    $view=(display_post_views(get_the_ID())) ? display_post_views(get_the_ID()) : 0 ;
        $view_string="<span class='index_meta'>".__(' Views')." : ".$view."</span>";
    }
    else{
        $view_string='';
    }
	return "<span class='index_meta'>".$date."</span>".$view_string;
}

/*==========================================
		 Add Views Number
============================================*/

function sunset_save_post_views($postID){
	$metaKey='sunset_post_views';
	$views=get_post_meta($postID,$metaKey,true);
	if(empty($views)){
		$count=0;
		$views=0;
		$count++;
		update_post_meta( $postID, 'sunset_post_views', $count);
		return $views;
	}
	else {
		$count = $views;
		$count ++;
		update_post_meta( $postID, 'sunset_post_views', $count );
		return $views;
	}
}
function display_post_views($postID){
	return get_post_meta($postID,'sunset_post_views',true);
}
/*==========================================
	Prevent Views Increment on Page Refresh
============================================*/

function set_user_cookie($post) {
	if(!$_COOKIE[$post]) {
		setcookie( $post, true, time() + 60 * 60 * 24 );
	}
}

/*==========================================
		 HTML5 SUPPORT
============================================*/

$args = array(
	'search-form',
	'comment-form',
	'comment-list',
	'gallery',
	'caption'
);
add_theme_support( 'html5', $args );

/*==========================================
		 Check Plugin Activation
============================================*/
function check_plugin_activation($plugin_dir){
    $plugins=get_option( 'active_plugins', array());
    $plugins=array_flip($plugins);
    if(isset($plugins[$plugin_dir])) {
        return true;
    }
    else {
        return false;
    }
}

/*==========================================
		 Post Navigation System
============================================*/

function blog_post_navigation(){
	$post_nav=get_the_posts_pagination( array(
		'prev_text' => twentyseventeen_get_svg( array( 'icon' => 'arrow-left' ) ) . '<span class="screen-reader-text">' . __( 'Previous page', 'twentyseventeen' ) . '</span>',
		'next_text' => '<span class="screen-reader-text">' . __( 'Next page', 'twentyseventeen' ) . '</span>' . twentyseventeen_get_svg( array( 'icon' => 'arrow-right' ) ),
		'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentyseventeen' ) . ' </span>',
	) );
	return $post_nav;
}

// Important Function below . Just copy it for the above function to work properly

function twentyseventeen_get_svg( $args = array() ) {
	// Make sure $args are an array.
	if ( empty( $args ) ) {
		return __( 'Please define default parameters in the form of an array.', 'twentyseventeen' );
	}

	// Define an icon.
	if ( false === array_key_exists( 'icon', $args ) ) {
		return __( 'Please define an SVG icon filename.', 'twentyseventeen' );
	}

	// Set defaults.
	$defaults = array(
		'icon'        => '',
		'title'       => '',
		'desc'        => '',
		'fallback'    => false,
	);

	// Parse args.
	$args = wp_parse_args( $args, $defaults );

	// Set aria hidden.
	$aria_hidden = ' aria-hidden="true"';

	// Set ARIA.
	$aria_labelledby = '';

	if ( $args['title'] ) {
		$aria_hidden     = '';
		$unique_id       = uniqid();
		$aria_labelledby = ' aria-labelledby="title-' . $unique_id . '"';

		if ( $args['desc'] ) {
			$aria_labelledby = ' aria-labelledby="title-' . $unique_id . ' desc-' . $unique_id . '"';
		}
	}

	// Begin SVG markup.
	$svg = '<i class="fa fa-' . esc_attr( $args['icon'] ) . '"' . $aria_hidden . $aria_labelledby . '>';

	$svg .= ' <use href="#icon-' . esc_html( $args['icon'] ) . '" xlink:href="#icon-' . esc_html( $args['icon'] ) . '"></use> ';

	// Add some markup to use as a fallback for browsers that do not support SVGs.
	if ( $args['fallback'] ) {
		$svg .= '<span class="svg-fallback icon-' . esc_attr( $args['icon'] ) . '"></span>';
	}
	$svg .= '</i>';

	return $svg;
}
/**/
function get_featured_post(){
	$query = new WP_Query( array(
		'post_type' => 'post',
		'posts_per_page' => 1,
		'tax_query' => array( array(
			'taxonomy' => 'post_format',
			'field' => 'slug',
			'terms' => array('post-format-aside'),
		) )
	));
	$post_not_in='';
	if($query->have_posts()):
		while ($query->have_posts()):
			$query->the_post();
			$post_not_in=get_the_ID();
			include get_template_directory().'/featured-post.php';
		endwhile;
	endif;
	$_SESSION['$post_not_in']=$post_not_in;
	return $post_not_in;
}
?>
