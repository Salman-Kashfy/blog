<h1>General Options</h1>
<?php
settings_errors();
$first_name=esc_attr(get_option('first_name'));
$last_name=esc_attr(get_option('last_name'));
$picture=esc_attr(get_option('author_picture'));
$twitter=esc_attr(get_option('twitter_handler'));
$facebook=esc_attr(get_option('facebook_handler'));
$google=esc_attr(get_option('google_handler'));
?>
<div class="container">
	<div>
		<div class="image-container">
			<div id="profile-picture-preview" class="profile-picture" style="background-image: url(<?php ($picture) ? print $picture : print get_template_directory_uri(). '/css/Default-avatar.jpg'; ?>);"></div>
            <?php echo "<h3>".$first_name." ".$last_name."</h3>" ?>
            <ul>
				<?php if($facebook): ?>
                    <li><a href="https://www.facebook.com/<?php echo $facebook?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
				<?php endif; ?>
	            <?php if($twitter): ?>
                    <li><a href="https://twitter.com/<?php echo $twitter?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
	            <?php endif; ?>
	            <?php if($google): ?>
                    <li><a href="https://plus.google.com/<?php echo $google?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>
	            <?php endif; ?>
            </ul>
		</div>
	</div>
	<div>
		<form method="post" action="options.php" id="general-form">
			<?php
			settings_fields('blog_general_settings');   //load settings group
			do_settings_sections('blog_admin');       //load section fields
			submit_button('Save Changes','primary','btnSubmit');
			?>
		</form>
	</div>
</div>