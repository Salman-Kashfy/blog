<?php $clearfix=$_SESSION['clearfix']%2; ?>
<div class="col-xs-12 col-sm-6 index_post <?php if($clearfix){echo 'clear';} ?>">
			<div class="index_content">

                <?php if(sunset_get_embedded_media( array('video','iframe') )): ?>

                    <span class="box video">
                        <a class="index_thumbnail1" href='<?php echo esc_url(get_the_permalink());?>'>
                            <?php echo sunset_get_embedded_media( array('video','iframe') ); ?>
                        </a>
                    </span>

                <?php else: ?>
                <div class='box no_thumbnail'><div class='table'><div class='table-cell'><i class="fa fa-video-camera" aria-hidden="true"></i></div></div></div>

                <?php endif; ?>
                <div class="index_content_inner">
                    <div class="index_meta_wrapper text-left">
                        <?php echo index_meta() ?>
                    </div>
                    <a href='<?php echo esc_url(get_the_permalink()); ?>'><h1 class='index_title text-left'><?php the_title(); ?></h1></a>
                    <?php the_excerpt(); ?>


                    <span class="index_categories"><i class="fa fa-pencil"></i><?php echo get_blog_category(); ?></span>
                </div>
			</div>
	<?php get_the_excerpt(); $_SESSION['clearfix']=$_SESSION['clearfix']+1; ?>

</div>