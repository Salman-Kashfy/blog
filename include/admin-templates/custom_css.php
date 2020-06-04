<h1>Custom CSS</h1>
<?php
settings_errors(); ?>
<form method="post" action="options.php" id="general-form">
    <?php
    settings_fields('blog_custom_css');   //load settings group
    do_settings_sections('custom_css');       //load section fields
    submit_button();
    ?>
</form>