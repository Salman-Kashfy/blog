<article id="post-<?php the_ID(); ?>" <?php post_class('standard_post_format col-xs-12'); ?>>


            <?php the_title('<h1 class="post_title">','</h1>'); ?>

        <?php
        if(has_post_thumbnail()):?>
            <div class="post_thumbnail"><?php the_post_thumbnail(); ?></div>
        <?php endif ;?>
        <div class="post_content">
                <?php
                the_content( sprintf(
                    __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'twentyseventeen' ),
                    get_the_title()
                ) );
                ?>
        </div>
    <div class='sunset-shareThis text-center'>
        <?php get_template_part('share-post'); ?>
    </div>

</article>