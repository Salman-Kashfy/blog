<?php get_header(); ?>
<div class="container">
    <div class="blog_area">
        <div class="row">
            <div class="col-sm-12 col-md-9">
                <div class="row">
	                <?php
	                if(have_posts()):
		                while(have_posts()): the_post();
			                get_template_part('template_parts/page');
		                endwhile;
	                endif;
	                ?>
                </div>
            </div>
            <div class="col-sm-12 col-md-3">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
