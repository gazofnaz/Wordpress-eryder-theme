<?php get_header(); ?>

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <h1><?php the_title(); ?></h1>

    <img src="<?php echo get_template_directory_uri(); ?>/screenshot.png" class="img-responsive"/>

    <?php 
        the_content();
        endwhile; endif;
    ?>
    
<?php /* footer */ get_footer(); ?>