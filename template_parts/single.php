<article id="post-<?php the_ID(); ?>" <?php post_class('single_post standard_post_format col-xs-12'); ?>>

            <?php
            if(!$_COOKIE[get_the_ID()] && !is_user_logged_in()){
	          sunset_save_post_views(get_the_ID());//Increase Post Views
            }
            the_title('<h1 class="post_title underline">','</h1>'); ?>

        <span class='post-author'>
            <?php echo get_avatar(get_the_author_meta('user_email'),'50');?>
            <span class='author_name'><?php _e('By: '); the_author_link(); ?></span>
        </span>
        <div class="post_date"><?php echo __('Posted on '); echo get_the_date(); ?></div>

        <?php
        if(get_option('display_post_thumbnail') && has_post_thumbnail()):?>
            <div class="post_thumbnail"><?php the_post_thumbnail(); ?></div>
        <?php endif ;?>
        <div class="post_content">
                <?php
                the_content( sprintf(
                    __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'twentyseventeen' ),
                    get_the_title()
                ) );
                ?>
        </div>
    <div class='sunset-shareThis text-center'>
        <?php get_template_part('share-post'); ?>
    </div>

</article>

<!--    RELATED POST    -->
<?php
global $post;


$cat_name=get_the_category($post->ID);
$cat_ids=$cat_name[0]->term_id;
$post_tags = wp_get_post_tags($post->ID, array( 'fields' => 'ids' ));

$args=array(
	'post_type'     =>  'post',
	'category__in'  =>  $cat_ids,
		'tag__in'       => $post_tags,
	'post__not_in'  =>  array($post->ID),        //post__not_in should always be in array()
	'order'         => 'DESC',
);
$related_post= new WP_Query($args);

if($related_post->have_posts()):
	echo "<h2 id='related' class='text-center btn-block'><span>".__('Related Articles')."</span></h2>";
	while($related_post->have_posts()):$related_post->the_post();
		get_template_part('template_parts/content',get_post_format());
	endwhile;
	wp_reset_query();
endif;
?>