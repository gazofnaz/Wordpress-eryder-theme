<?php

    get_header();

?>
<?php if (have_posts()) : ?>
<div class="row">
    <div class="ga-box-list">

<?php 

    $count = 0;
    while ( have_posts() ) : the_post();
    $count ++;
    $post_image_src = get_post_gallery_images( $post );

    if( $count % 3 == 0 ){
        echo '<div class="row">';
    }

?>
        <div class="col-md-4 col-sm-11 no-left-gutter">
            <!-- first item always has "no-left-gutter"-->
            <div class="box-item pull-left col-sm-11 col-xs-11">
                <a href="<?php the_permalink() ?>" class="img-crop">
                    <img src="<?php echo $post_image_src[0] ?>" class="img-responsive"/>
                </a>
                <div class="clearfix"></div>
                <div class="ga-box-links" >
                    <p class="text-center">
                        <a href="<?php the_permalink() ?>"><?php the_title(); ?>
                    </a>
                    </p>
                </div>
            </div>
        </div>
<?php 

    if( $count % 3 == 0 ){
        echo '</div>';
    }

?>

<?php endwhile; ?>
    </div><!-- ga-box-list -->
</div>

<?php endif; /* end if have_posts */ ?>      
    
<?php

   get_footer();

?>