<?php

    get_header();

    if ( have_posts() ) : while ( have_posts() ) : the_post();
    $post_image_src = getAllPostImages();

?>

<div class="row">
    <div class="col-sm-12">
        <div id="the-content">
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


