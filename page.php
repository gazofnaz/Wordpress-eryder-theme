<?php

    get_header();
    if ( have_posts() ) : while ( have_posts() ) : the_post();

?>

<div class="row">
    <div class="col-sm-12 top-padding">

<?php 
        the_content();
        endwhile; endif;
?>

    </div>
</div>

<?php

   get_footer();

?>