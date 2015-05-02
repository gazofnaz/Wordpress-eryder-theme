<?php

    get_header();

    if ( have_posts() ) : while ( have_posts() ) : the_post();
    $post_image_src = getAllPostImages();

?>

<div class="row">
    <div class="col-sm-12">
        <h1><?php the_title( '' ); ?></h1>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="col-md-12 carousel-bg-bottom">
            <div id="carousel-bounding-box">
                <div>
<?php

                        the_content();
                        endwhile; endif;

?>
                </div>
            </div>
        </div>
    </div>
</div>


<?php

   get_footer();

?>


