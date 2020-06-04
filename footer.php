<?php wp_footer(); ?>
<footer class="text-center">
    <p class="copyrights"><i class="fa fa-copyright" aria-hidden="true"></i> <?php _e('Copyrights ');  echo date("Y"); ?></p>
    <p> <?php _e('Created and Developed by'); ?> <span class="theme-color"><?php echo esc_html(get_option('first_name')." ".get_option('last_name')); ?></span></p>
</footer>
</body>
</html>
