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
                    <div class="picture" itemscope itemtype="http://schema.org/ImageGallery">
<?php

                    // foreach( $post_image_src as $index => $img_src ){
                    //     // print active class for first image
                    //     $isActive = ( $index == 0 ? ' active ' : '' );
                    //     $img_tag = '<figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">';
                    //     $img_tag .= sprintf( '<a href="%s" itemprop="contentUrl" data-size="150x150" data-index="1"><img src="%s" height="150" width="150" itemprop="thumbnail" alt=""></a>', $img_src, $img_src );
                    //     $img_tag .= '</figure>';
                    //     echo $img_tag;
                    // }

?>
                    </div>
                </div>
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


