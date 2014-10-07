<?php get_header(); ?>
<div class="col-sm-12">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <h1><?php the_title(); ?></h1>

    <?php $post_image_src = get_post_custom()['wpcf-post-image'][0]; ?>

    <div class="html_carousel">
        <div id="carousel">
            <div class="slide">
                <img src="<?php echo $post_image_src ?>" alt="carousel 1" width="870" height="400" />
                <div>
                    <h4>Infinity</h4>
                    <p>A concept that in many fields refers to a quantity without bound or end.</p>
                </div>
            </div>
            <div class="slide">
                <img src="<?php echo $post_image_src ?>" alt="carousel 1" width="870" height="400" />
                <div>
                    <h4>Infinity</h4>
                    <p>A concept that in many fields refers to a quantity without bound or end.</p>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="thumbnails" id="carousel_thumbs"></div>
    </div>

    <?php 
        the_content();
        endwhile; endif;
    ?>

<?php /* footer */ get_footer(); ?>