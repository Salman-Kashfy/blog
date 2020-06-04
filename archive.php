<?php get_header(); ?>
<div class="container">
    <div class="blog_area">
        <div class="row">
            <div class="col-sm-12 col-md-9 flex-container">
                <div class="row">
                    <div class="flex-container">
                        <?php
                            if(have_posts()):
                                $_SESSION['clearfix']=1;
                                while (have_posts()):
                                    the_post();
                                    get_template_part('template_parts/content',get_post_format());
                                endwhile;
                            endif;
                            wp_reset_postdata();
                        ?>
                    </div>
                </div>
	            <?php if(have_posts()){echo "<div id='post_navigation' class='btn-block text-center'>".blog_post_navigation()."</div>";} ?>
            </div>
            <div class="col-sm-12 col-md-3">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
