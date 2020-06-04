<article id="post-<?php the_ID(); ?>" <?php post_class('standard_post_format'); ?>>
<?php
	$output= "<div class='col-xs-12'>";
	$output.="<div class='post_title'><h1><a href='".esc_url(get_the_permalink())."'>".get_the_title()."</a></h1></div>";
	$output.="<div class='post_date'>".get_the_date()."</div>";
	$output.="<span class='post-author'>".get_avatar(get_the_author_link(),45)."<span><h5 class='author_name'>By: ".get_the_author_link()."</h5></span></span>";


    $attachments=sunset_get_attachment(7);
    var_dump($attachments);

$output.="</div>";
	echo $output;
?>
</article>
<?php
	global $post;
	$cat_name=get_the_category($post->ID);
	$cat_ids=$cat_name[0]->term_id;
	$post_tags = wp_get_post_tags($post->ID, array( 'fields' => 'ids' ));

	$args=array(
		'post_type'     =>  'post',
		'category__in'  =>  $cat_ids,
//		'tag__in'       => $post_tags,
		'post__not_in'  =>  array($post->ID),        //post__not_in should always be in array()
		'order'         => 'DESC'
	);
	$related_post= new WP_Query($args);

	if($related_post->have_posts()):
		echo "<h2 class='text-center btn-block'>Related Articles</h2>";
		while($related_post->have_posts()):$related_post->the_post();
			get_template_part('template_parts/content',get_post_format());
		endwhile;
	endif;
?>
