<?php get_header(); global $paged;?>
<?php if($paged==0){$post_not_in =get_featured_post();} else{$post_not_in='';} ?><!--Show Featured Post only on Front Page-->
<div class="container">
    <div class="blog_area">
        <div class="row">
            <div class="col-sm-12 col-md-9 flex-container">
                <div class="row">
                    <div class="flex-container">
                        <?php
                            if(is_home()):
                                $query=new WP_Query(array(
                                    'post_type'=>'post',
                                    'paged'     =>$paged,
                                    'post__not_in'=>array($post_not_in)
                                ));
                                if($query->have_posts()):
                                    $_SESSION['clearfix']=1;
                                    while ($query->have_posts()):
	                                    $query->the_post();
                                        //if(get_the_ID()!=$post_not_in): //  Does not show featured post
                                            get_template_part('template_parts/content',get_post_format());
                                        //endif;
                                    endwhile;
                                endif;
                                wp_reset_postdata();
                            endif;
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
