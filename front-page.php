<?php

    get_header();

?>
<div id="home">
    <div class="row">
        <div class="col-sm-12">
<?php 
        if ( have_posts() ) : while ( have_posts() ) : the_post();
        $post_image_src = getAllPostImages( 1 );
?>

            <img src="<?php echo $post_image_src[0] ?>" class="img-responsive" />

<?php 
        the_content();
        endwhile; endif;
?>

        </div>
    </div>
</div>

<?php

   get_footer();

?>