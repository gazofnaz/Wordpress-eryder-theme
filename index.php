<?php get_header(); ?>

<div class="container">
    <div class="row">
        <div class="col-sm-12">
    	<?php if (!is_single() && !is_page() && !is_front_page()) : ?><h1><?php wp_title(' ', true, 'right'); ?></h1><?php endif; ?>
        
        <?php /* begin the loop */ if (have_posts()) : ?>
		
		<?php while (have_posts()) : the_post(); ?>
        
			<?php if (is_page()) : /* show page contents */ ?>
            
                <div id="post-<?php the_ID(); ?>">
                    <h1><?php the_title(); ?></h1>
                    <?php the_content('Read more &gt;'); ?> 
                    <p><?php wp_link_pages('next_or_number=number&pagelink=page %'); ?></p>
                    <p><?php edit_post_link('Edit', '[ ', ' ]'); ?></p>  
                </div>
            
            <?php elseif (is_search()) : /* show search results */ ?>
            
                <div class="searchresults">
                <div class="post" id="post-<?php the_ID(); ?>">
                    <div class="postcontents">
                        <h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
                        <?php the_excerpt(); ?> <a href="<?php the_permalink() ?>"><?php the_permalink() ?></a>   
                    </div>
                </div>
                </div>
            
            <?php else : /* show post contents */ ?>
                <div class="ga-box-list">
                    <div class="col-md-4 col-sm-11 no-left-gutter">
                        <!-- first item always has "no-left-gutter"-->
                        <div class="box-item pull-left col-sm-11 col-xs-11">
                            <p class="ga-box-description"><h4><?php the_title(); ?></45></p>
                            <a href="<?php the_permalink() ?>">
                                <img src="<?php echo get_template_directory_uri(); ?>/screenshot.png" />
                            </a>
                            <div class="clearfix"></div>
                            <p class="ga-box-description"><?php the_content('Read more &gt;'); ?> </p>
                            <div class="ga-box-links" >
                                <p class="text-center"><a href="#">Find out more...</a></p>
                            </div>
                        </div>
                    </div>
                    <!-- @todo divisible by 3 -->
                    <!-- <div class="clearfix"></div> -->
                </div>
            <?php endif; /* end if page or post */ ?>
        
        <?php endwhile;/* end the main loop */ ?>
        
        <!-- @todo previous / next post buttons are nice if they have the actual post name in the link -->
        
        <?php else : /* show page not found message */ ?>
        <!-- @todo add a 404 page -->
        <div>
            <h1>Page not found</h1>
            <p>Sorry, the page you are looking for is not available. It may have moved, or you may have followed a bad link. Please 
            <a href="<?php bloginfo('url') ?>">visit our homepage</a> to find what you're looking for.</p>
        </div>
        
        <?php endif; /* end if have_posts */ ?>      
    
    
        </div><!-- / end content -->
    </div>
</div><!-- / end main -->

<?php /* footer */ get_footer(); ?>