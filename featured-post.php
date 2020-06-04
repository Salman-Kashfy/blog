<style>
    #featured-image{
        text-align: center; position: relative;
    }
    #featured-title{
        position: absolute;
        top: 40%;
        left: 50%;
        margin: 0;
        width: 37%;
        background-color: rgba(0,0,0,0.7);
        color: #fafafa;
        padding: 5px 0;
        border-radius: 60px;
    }
    #check{
        width: 600px;
        margin: 0 auto;
    }
    @media screen and (max-width: 767px) {
        #featured-title{
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            width: initial;
            background-color: rgba(10,10,10,0.7);
            top: initial;
            font-size: 26px;
            border-radius: 0;
        }
        #check{
            width: 100%;
        }

    }
</style>

<article id="featured">
    <a href='<?php echo esc_url(get_the_permalink()); ?>'>
        <div id="featured-image">
            <?php the_post_thumbnail(); ?>
            <div id="check">
                <h1 id="featured-title"><?php the_title(); ?></h1>
            </div>
        </div>
    </a>
</article>
