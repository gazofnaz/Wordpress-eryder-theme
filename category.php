<?php

    get_header();

?>

<div class="row">
    <div class="col-sm-12">
        <h1><?php wp_title( '' ); ?></h1>
    </div>
</div>
<?php if (have_posts()) : ?>
<div class="row">
    <div class="ga-box-list">

<?php 

    $count = 0;
    while (have_posts()) : the_post(); 
    $count ++;
    $post_image_src = getAllPostImages( 1 );

    if( $count % 3 == 0 ){
        echo '<div class="row">';
    }

?>
        <div class="col-md-4 col-sm-11 no-left-gutter">
            <!-- first item always has "no-left-gutter"-->
            <div class="box-item pull-left col-sm-11 col-xs-11">
                <a href="<?php the_permalink() ?>">
                    <img src="<?php echo $post_image_src[0] ?>" class="img-responsive"/>
                </a>
                <div class="clearfix"></div>
                <p class="ga-box-description">
                    <h3>
                        <a href="<?php the_permalink() ?>">
                            <?php the_title(); ?>
                        </a>
                    </h3>
                </p>
                <p class="ga-box-description">
                    <?php the_content('Read more &gt;'); ?>
                </p>
                <div class="ga-box-links" >
                    <p class="text-center">
                        <a href="<?php the_permalink() ?>">Find out more...
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