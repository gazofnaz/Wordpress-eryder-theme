<?php get_header(); ?>
<div class="col-sm-12">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <h1><?php the_title(); ?></h1>

    <?php $post_image_src = get_post_custom()['wpcf-post-image'][0]; ?>

    <img src="<?php echo $post_image_src ?>" class="img-responsive"/>

    <?php 
        the_content();
        endwhile; endif;
    ?>
</div> 
<?php /* footer */ get_footer(); ?>