<?php

    get_header();

?>
<div class="row">
    <div class="col-sm-12">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

        <h1><?php the_title(); ?></h1>
    </div>
</div>
<?php 
    
    $post_image_src = [];

    foreach( get_post_custom()['wpcf-post-image'] as $img_src ){
        $post_image_src[] = $img_src; 
    }

?>
<div class="row">
    <div class="col-md-12 hidden-sm hidden-xs" id="slider-thumbs">
        <ul class="list-inline">
<?php

    foreach( $post_image_src as $index => $img_src ){
        $img_src = getImageVariaton( $img_src, '-150x150' );
        // print selected class for first image
        $isSelected = ( $index == 0 ? ' selected ' : '' );
        $img_tag = sprintf( '<li><a id="carousel-selector-%s" class="%s"><img src="%s" class="img-responsive" /></a></li>', $index, $isSelected, $img_src );
        echo $img_tag;
    }

?>       
        </ul>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
    <div id="carousel-bounding-box">
            <div id="postCarousel" class="carousel slide">
                <div class="carousel-inner">
<?php

                foreach( $post_image_src as $index => $img_src ){
                    // print active class for first image
                    $isActive = ( $index == 0 ? ' active ' : '' );
                    $img_tag = sprintf( '<div class="%s item" data-slide-number="%s"><img src="%s" class="img-responsive" /></div>', $isActive, $index, $img_src );
                    echo $img_tag;
                }

?>
                </div>
                <a class="carousel-control left" href="#postCarousel" data-slide="prev">‹</a>
                <a class="carousel-control right" href="#postCarousel" data-slide="next">›</a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
<?php 

    the_content();
    endwhile; endif;

?>
    </div>
</div>

<?php

   get_footer();

?>


