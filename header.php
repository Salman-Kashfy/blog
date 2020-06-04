<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<title><?php bloginfo('name'); wp_title('|');?></title>
	<meta charset="<?php bloginfo('charset') ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="profile" href="http://gmpg.org/xnf/11">
	<?php if(is_singular() && pings_open(get_queried_object() ) ):  ?>
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	<?php endif; ?>

	<meta name="description" content="Daily life Blog">
	<meta name="keywords" content="music,life,health,beauty,fun,politics,news,love,humanity">
	<meta property="author" content="<?php echo esc_attr(get_option('first_name'))." ".esc_attr(get_option('last_name')); ?>">
    <script src='https://www.google.com/recaptcha/api.js'></script>

    <meta property="og:url"                content="<?php echo "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>" />
    <meta property="og:type"               content="article" />
    <meta property="og:title"              content="<?php the_title(); ?>" />
    <meta property="og:description"        content="<?php bloginfo('description'); ?>" />
	<?php if(get_the_post_thumbnail_url()): ?>
        <meta property="og:image"              content="<?php echo get_the_post_thumbnail_url() ?>"/>
        <meta property="twitter:image"         content="<?php echo get_the_post_thumbnail_url() ?>"/>
	<?php endif; ?>

    <meta property="twitter:url"           content="<?php echo "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>" />
    <meta property="twitter:type"          content="article" />
    <meta property="twitter:title"         content="<?php the_title(); ?>" />
    <meta property="twitter:description"   content="<?php bloginfo('description'); ?>" />
    <meta property="twitter:card"          content="summary_large_image">


	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <div class="table">
                <a href="#" id="hide1" class="logo" style="display: none;"><img src="<?php header_image(); ?>"></a>
                <div class="table-cell">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="true">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
            </div>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <div class="table">
                <a href="#" id="hide2" class="logo" style="display:block;"><img src="<?php header_image(); ?>"></a>
                <div class="table-cell ">
	                <?php
	                $args=array(
		                'theme_location'=>'primary',
		                'container'=>false,
		                'menu_class'=>'nav navbar-nav text-center',
                        'walker'=> new Walker_Nav_Primary
	                );
	                wp_nav_menu($args);
	                ?>
                </div>
            </div>
        </div>
    </div>
</nav>
<?php //get_search_form(true) ?>