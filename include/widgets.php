<?php
/*===========================================
		Author Profile
=============================================*/
class WP_blog_profile_picture extends WP_Widget{
	public function __construct() {
		$widget_options=array(
			'classname'=>'blog_widget_class',
			'description'=>'Blog Widget'
		);
		parent::__construct( 'WP_blog_profile_picture', 'Blog Author', $widget_options);
	}
	public function form( $instance ) {

		$title= ( !empty($instance['title']) ? $instance['title'] : 'About Author' );
//		$tot= (!empty($instance['tot']) ? absint($instance['tot']) : 4);

		$output="<p>";
		$output.="<label for='".esc_attr($this->get_field_id('title'))."'>Title:</label>";
		$output.="<input type='text' class='widefat' id='".esc_attr($this->get_field_id('title'))."' name='".esc_attr($this->get_field_name('title')). "' value='".esc_attr($title)."'>";
		$output.="</p>";

		$output.= "<p><strong>Upload Profile Picture via Admin Panel</strong><br>You can control this option at
			<a href='./admin.php?page=blog_admin'>This page</a></p>";

		echo $output;
	}
	//widget font-end
	public function widget( $args, $instance ) {
		$firstname=esc_attr(get_option('first_name'));
		$lastname=esc_attr(get_option('last_name'));
		$picture=esc_attr(get_option('author_picture'));
		$twitter=esc_attr(get_option('twitter_handler'));
		$facebook=esc_attr(get_option('facebook_handler'));
		$google=esc_attr(get_option('google_handler'));

		echo $args['before_widget'];
		if(!empty($instance['title'])):
			echo $args['before_title'].apply_filters('widget_title',$instance['title']).$args['after_title'];
		endif;
		?>
		<div class="text-center">
			<div class="image-container">
				<div id="profile-picture-preview" class="profile-picture" style="background-image: url(<?php print $picture; ?>);"></div>
			</div>
			<?php echo "<h4>".$firstname." ".$lastname."</h4>" ?>
			<div class="sunset-shareThis">
				<ul class="social">
					<?php if($twitter): ?>
						<li><a href="https://twitter.com/<?php echo $twitter ?>" target="_blank"><i id="twitter" class="fa fa-twitter"></i></a></li>
					<?php endif ?>
					<?php if($facebook): ?>
						<li><a href="https://www.facebook.com/<?php echo $facebook ?>" target="_blank"><i id="facebook" class="fa fa-facebook"></i></a></li>
					<?php endif; ?>
					<?php if($google): ?>
						<li><a href="https://plus.google.com/<?php echo $google ?>" target="_blank"><i id="google" class="fa fa-google-plus"></i></a></li>
					<?php endif; ?>
				</ul>
			</div>
		</div>
		<?php
		echo $args['after_widget'];
	}
}
add_action('widgets_init',function () {
	register_widget( 'WP_blog_profile_picture' );
});
/*===========================================
		Popular
=============================================*/

/*  Widget back/front End
--------------------------------------*/
class Sunset_Popular_Post_Widget extends WP_Widget{
	public function __construct() {
		//widget setup
		$widget_options=array(
			'classname'=>'blog_thumbnail_widget',
			'description'=>'Display most viewed Post'
		);
		parent::__construct('sunset_popular_post_id', 'Blog Popular Posts', $widget_options);
	}
	//widget back-end
	public function form( $instance ) {
		$title= ( !empty($instance['title']) ? $instance['title'] : 'Popular Posts' );
		$tot= (!empty($instance['tot']) ? absint($instance['tot']) : 4);

		$output="<p>";
		$output.="<label for='".esc_attr($this->get_field_id('title'))."'>Title:</label>";
		$output.="<input type='text' class='widefat' id='".esc_attr($this->get_field_id('title'))."' name='".esc_attr($this->get_field_name('title')). "' value='".esc_attr($title)."'>";
		$output.="</p>";

		$output.="<p>";
		$output.="<label for='".esc_attr($this->get_field_id('tot'))."'>Number of Post:</label>";
		$output.="<input type='number' class='widefat' id='".esc_attr($this->get_field_id('tot'))."' name='".esc_attr($this->get_field_name('tot')). "' value='".esc_attr($tot)."'>";
		$output.="</p>";
		echo $output;
	}
	public function widget($args,$instance){

		$post_args=array(
			'post_type'         =>'post',
			'posts_per_page'    => $instance['tot'],
			'meta_key'          => 'sunset_post_views',      //from views section
			'orderby'           => 'meta_value_num',
			'order'             =>'DESC'
		);
		$post_query= new WP_Query($post_args);

		echo $args['before_widget'];                        //<section>
		if(!empty($instance['title'])):
			echo $args['before_title'].apply_filters('widget_title',$instance['title']).$args['after_title'];
		endif;

		echo "<ul>";
		if($post_query->have_posts()):
			while($post_query->have_posts()): $post_query->the_post();
				the_title(sprintf("<li><a href='%s'><span class='popular_post'><img  src='".get_the_post_thumbnail_url()."'></span><div>", esc_url( get_permalink() ) ),'</div></a></li>' );
			endwhile;
		endif;
		echo "</ul>";

		echo  $args['after_widget'];                        //</section>
	}

}
add_action('widgets_init',function () {
	register_widget( 'Sunset_Popular_Post_Widget' );
});

/*===========================================
		Most Recent Post
=============================================*/

/*  Widget back/front End
--------------------------------------*/
class Sunset_Recent_Post_Widget extends WP_Widget{
	public function __construct() {
		//widget setup
		$widget_options=array(
			'classname'=>'blog_thumbnail_widget',
			'description'=>'Blog Recent Post Widget'
		);
		parent::__construct('sunset_recent_post_id', 'Blog Recent Posts', $widget_options);
	}
	//widget back-end
	public function form( $instance ) {
		$title= ( !empty($instance['recent_title']) ? $instance['recent_title'] : 'Blog Recent Posts' );
		$tot= (!empty($instance['recent_tot']) ? absint($instance['recent_tot']) : 4);

		$output="<p>";
		$output.="<label for='".esc_attr($this->get_field_id('recent_title'))."'>Title:</label>";
		$output.="<input type='text' class='widefat' id='".esc_attr($this->get_field_id('recent_title'))."' name='".esc_attr($this->get_field_name('recent_title')). "' value='".esc_attr($title)."'>";
		$output.="</p>";

		$output.="<p>";
		$output.="<label for='".esc_attr($this->get_field_id('tot'))."'>Number of Post:</label>";
		$output.="<input type='number' class='widefat' id='".esc_attr($this->get_field_id('recent_tot'))."' name='".esc_attr($this->get_field_name('recent_tot')). "' value='".esc_attr($tot)."'>";
		$output.="</p>";
		echo $output;
	}
	public function widget($args,$instance){

		$post_args=array(
			'post_type'         =>'post',
			'posts_per_page'    => $instance['recent_tot'],
		);
		$post_query= new WP_Query($post_args);

		echo $args['before_widget'];                        //<section>
		if(!empty($instance['recent_title'])):
			echo $args['before_title'].apply_filters('widget_title',$instance['recent_title']).$args['after_title'];
		endif;

		echo "<ul>";
		if($post_query->have_posts()):
			while($post_query->have_posts()): $post_query->the_post();
				the_title(sprintf("<li><a href='%s'><span class='popular_post'><img  src='".get_the_post_thumbnail_url()."'></span><div>", esc_url( get_permalink() ) ),'</div></a></li>' );
			endwhile;
		endif;
		echo "</ul>";

		echo  $args['after_widget'];                        //</section>
	}

}
add_action('widgets_init',function () {
	register_widget( 'Sunset_Recent_Post_Widget' );
});


?>