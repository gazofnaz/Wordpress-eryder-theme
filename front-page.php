<?php

    get_header();

?>
<div id="home">
    <div class="row">
        <div class="col-sm-12">
<?php 
        if ( have_posts() ) : while ( have_posts() ) : the_post();
        $post_image_src = getAllPostImages();
?>

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
<?php
// only show arrows if we have more than one image       
if( count( $post_image_src > 1 ) ):
?>
                <a class="carousel-control left" href="#postCarousel" data-slide="next">
                    <span class="glyphicon glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="carousel-control right" href="#postCarousel" data-slide="next">
                    <span class="glyphicon glyphicon glyphicon-chevron-right"></span>
                </a>

<?php                 
endif;
?> 
            </div>
        </div>
    </div>
</div>

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