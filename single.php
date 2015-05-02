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
        <div class="carousel-box">
            <div class="picture" itemscope itemtype="http://schema.org/ImageGallery">
                <ul class="list-inline">
<?php

            the_content();
            endwhile; endif;

?>

                </ul>
            </div>
        </div>
    </div>
</div>


<?php

   get_footer();

?>


