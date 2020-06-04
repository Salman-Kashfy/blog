<?php
/*
	if(is_single()):

		$title=get_the_title();
		$permalink=get_the_permalink();
		$twitterHandler=( is_user_logged_in() ? '&amp;via='.esc_attr(get_option('twitter_handler')):'' );

		$twitter="https://twitter.com/intent/tweet?text=".$title."&amp;url=".$permalink.$twitterHandler."data-size='large'";
		$facebook = 'https://www.facebook.com/sharer/sharer.php?u='.$permalink;
		$google = 'https://plus.google.com/share?url='.$permalink;
	?>  <h3><?php echo __('Share This'); ?></h3>
		<ul class="social">
		<li><a href='<?php echo $twitter; ?>' target="_blank" data-title="<?php the_title(); ?>"><i id="twitter"  class='fa fa-twitter'></i></a></li>
		<li><a href='<?php echo $facebook; ?>' target="_blank" data-title="<?php the_title(); ?>"><i id="facebook" class='fa fa-facebook'></i></a></li>
		<li><a href='<?php echo $google; ?>' target="_blank" data-title="<?php the_title(); ?>"><i id="google" class='fa fa-google-plus'></i></a></li></ul>
*/
	//<?php endif; ?>

<?php
/*
*	Share post
*/
?>
<?php
global $post;

$post_image_data = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'blog-thumb');
//echo get_the_post_thumbnail_url();
//echo $_SERVER['REQUEST_URI'];
if(has_post_thumbnail( $post->ID )) {
	$post_image = $post_image_data[0];
} else {
	$post_image = '';
}
?>
<div class="post-social-wrapper">
    <h3><?php echo __('Share This'); ?></h3>
    <ul class="social">
        <li><a title="<?php esc_html_e("Share this", 'dotadz'); ?>" href="<?php the_permalink(); ?>" data-title="<?php the_title(); ?>" data-image="<?php echo esc_attr($post_image); ?>" class="facebook-share"> <i id="facebook"  class="fa fa-facebook"></i></a></li>
        <li><a title="<?php esc_html_e("Tweet this", 'dotadz'); ?>" href="<?php the_permalink(); ?>" data-title="<?php the_title(); ?>" data-image="<?php echo esc_attr($post_image); ?>" class="twitter-share"> <i id="twitter" class="fa fa-twitter"></i></a></li>
        <li><a title="<?php esc_html_e("Share with Google Plus", 'dotadz'); ?>" href="<?php the_permalink(); ?>" data-title="<?php the_title(); ?>" data-image="<?php echo esc_attr($post_image); ?>" class="googleplus-share"> <i id="google" class="fa fa-google-plus"></i></a></li>
        <li><a title="<?php esc_html_e("Pin this", 'dotadz'); ?>" href="<?php the_permalink(); ?>" data-title="<?php the_title(); ?>" data-image="<?php echo esc_attr($post_image); ?>" class="pinterest-share"> <i id="pinterest" class="fa fa-pinterest"></i></a></li>
    </ul>
    <div class="clear"></div>
</div>
