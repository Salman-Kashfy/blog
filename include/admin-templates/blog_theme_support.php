<h1>Theme Options</h1>
<?php
settings_errors(); ?>
<form method="post" action="options.php" id="general-form">
    <?php
    settings_fields('blog_theme_support');   //load settings group
    do_settings_sections('theme_support');       //load section fields
    submit_button();
    ?>
</form>