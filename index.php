<?php

/**
 * Default page, only used as a failback
 */

get_header();

?>
    <div class="row">
        <div class="col-sm-12">
            <?php
            if ( have_posts() ) : while ( have_posts() ) : the_post();
                the_content();
            endwhile; endif;
            ?>
        </div>
    </div>

<?php

get_footer();

?>