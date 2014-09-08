<?php get_header(); ?>

    	<?php if( !is_single() 
                  && !is_page() 
                  && !is_front_page()) : ?>
                <h1><?php wp_title(' ', true, 'right'); ?></h1>
        <?php endif; ?>
        
        <?php if (have_posts()) : ?>
		
		<?php 

            $count = 0;
            while (have_posts()) : the_post(); 
            $count ++;
            $post_image_src = get_post_custom()['wpcf-post-image'][0];

        ?>
                <div class="ga-box-list">
                    <div class="col-md-4 col-sm-11 no-left-gutter">
                        <!-- first item always has "no-left-gutter"-->
                        <div class="box-item pull-left col-sm-11 col-xs-11">
                            <p class="ga-box-description"><h4><?php the_title(); ?></h4></p>
                            <a href="<?php the_permalink() ?>">
                                <img src="<?php echo $post_image_src ?>" class="img-responsive"/>
                            </a>
                            <div class="clearfix"></div>
                            <p class="ga-box-description"><?php the_content('Read more &gt;'); ?> </p>
                            <div class="ga-box-links" >
                                <p class="text-center"><a href="<?php the_permalink() ?>">Find out more...</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php 

                /* fix for variable height items */
                if( $count % 3 == 0 ){
                    echo "<div class='clearfix'></div>";
                }

            ?>
        
        <?php endwhile; ?>
        
        <!-- @todo previous / next post buttons are nice if they have the actual post name in the link -->
        
        <?php else : /* show page not found message */ ?>
        <!-- @todo add a 404 page -->
        <div>
            <h1>Page not found</h1>
            <p>Sorry, the page you are looking for is not available. It may have moved, or you may have followed a bad link. Please 
            <a href="<?php bloginfo('url') ?>">visit our homepage</a> to find what you're looking for.</p>
        </div>
        
        <?php endif; /* end if have_posts */ ?>      
    
<?php get_footer(); ?>