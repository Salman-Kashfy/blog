<?php if(!is_active_sidebar('unique-sidebar-id')){return;} ?>

<div id="sidebar" class="widget-area">
<!--    <div class="container-fluid">-->
    <div class="row">
	<?php dynamic_sidebar('unique-sidebar-id'); ?>
<!--    </div>-->
    </div>
</div>