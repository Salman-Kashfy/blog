<?php $clearfix=$_SESSION['clearfix']%2; ?>
<div class="col-xs-12 col-sm-6 index_post <?php if($clearfix){echo 'clear';} ?>">

			<div class="index_content">

                <?php if(has_post_thumbnail()): ?>

                    <span class="box">
                        <a class="index_thumbnail1" href='<?php echo esc_url(get_the_permalink());?>'>
                            <?php the_post_thumbnail();?>
                        </a>
                    </span>

                <?php else: ?>
                <div class='box no_thumbnail'><div class='table'><div class='table-cell'><i class='fa fa-image' aria-hidden='true'></i></div></div></div>

                <?php endif; ?>
                <div class="index_content_inner">
                    <div class="index_meta_wrapper text-left">
                        <?php echo index_meta() ?>
                    </div>
                    <a href='<?php echo esc_url(get_the_permalink()); ?>'><h1 class='index_title text-left'><?php the_title(); ?></h1></a>
                    <?php the_excerpt(); ?>
                    <div class="index_categories"><i class="fa fa-pencil"></i><?php echo get_blog_category(); ?></div>
                </div>
			</div>

	<?php  $_SESSION['clearfix']=$_SESSION['clearfix']+1; ?>

</div>