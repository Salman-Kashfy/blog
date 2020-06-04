<?php settings_errors(); ?>
<div style="width: 100%; height: 400px; background-color: #5bc0de"></div>
<form method="post" action="options.php" id="general-form">
	<?php
	settings_fields('blog_teaser_settings');   //load settings group
	do_settings_sections('teaser_post');       //load section fields
	submit_button('Save Changes','primary','btnSubmit');
	?>
</form>