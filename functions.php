<?php

/* automatic feed links */
add_theme_support('automatic-feed-links');
/*---*/

/**
 * Bootstrap Navigation Setup
 *
 * http://code.tutsplus.com/tutorials/how-to-integrate-bootstrap-navbar-into-wordpress-theme--wp-33410
 *
 */ 
add_action( 'after_setup_theme', 'wpt_setup' );
    if ( ! function_exists( 'wpt_setup' ) ):
        function wpt_setup() {  
            register_nav_menu( 'primary', __( 'Primary navigation', 'wptuts' ) );
        } endif;

require_once('wp_bootstrap_navwalker.php');
/*---*/

/* Javascript Includes for front end */
function load_all_scripts() {

    // jQuery is included with wordpress by default

    // @todo autoload these
    wp_enqueue_script(
        'bootstrap',
        get_stylesheet_directory_uri() . '/js/bootstrap.min.js',
        array( 'jquery' )
    );

    wp_enqueue_script(
        'custom',
        get_stylesheet_directory_uri() . '/js/custom.js',
        array( 'jquery', 'bootstrap' )
    );

    wp_enqueue_script(
        'photoswipe',
        get_stylesheet_directory_uri() . '/js/photoswipe.min.js',
        array( 'jquery' )
    );

    wp_enqueue_script(
        'photoswipe-ui',
        get_stylesheet_directory_uri() . '/js/photoswipe-ui-default.min.js',
        array( 'jquery' )
    );
}

add_action( 'wp_enqueue_scripts', 'load_all_scripts' );
/*---*/

/**
 * Get all images from the custom post type wpcf-post-image
 *
 * Allows a limit to be set, usually to fetch a single image
 *
 */
function getAllPostImages( $limit = null ){

    $post_image_src = [];

    if( ! $customFieldData = get_post_custom()['wpcf-post-image'] ){
        $customFieldData = array();
    }

    foreach( $customFieldData as $key => $img_src ){
        
        // allow for limited number to be returned
        if( $limit &&  $key +1 > $limit ){
            continue;
        }

        // backend allows for empty strings, which looks bad in the front end.
        if( $img_src == '' ){
            continue;
        }

        // just in case an image goes missing.
        // Annoyingly getimagesize throws a warning instead of returning false.
        if ( !@getimagesize( $img_src ) ) {
            continue;
        }

        $post_image_src[] = $img_src; 

    }

    return $post_image_src;

}

/** @todo create plugin */
remove_shortcode( 'gallery' );
add_shortcode( 'gallery', 'parse_gallery_shortcode' );

function parse_gallery_shortcode($atts) {
 
    global $post;
 
    if ( ! empty( $atts['ids'] ) ) {
        // 'ids' is explicitly ordered, unless you specify otherwise.
        if ( empty( $atts['orderby'] ) ){
            $atts['orderby'] = 'post__in';
        }   
        $atts['include'] = $atts['ids'];
    }
 
    extract( shortcode_atts( array(
        'orderby'       => 'menu_order ASC, ID ASC',
        'include'       => '',
        'id'            => $post->ID,
        'itemtag'       => 'dl',
        'icontag'       => 'dt',
        'captiontag'    => 'dd',
        'columns'       => 3,
        'size'          => 'thumbnail',
        'link'          => 'file'
    ), $atts ) );

    $args = array(
        'post_type'         => 'attachment',
        'post_status'       => 'inherit',
        'post_mime_type'    => 'image',
        'orderby'           => $orderby
    );
 
    if ( !empty( $include ) )
        $args['include'] = $include;
    else {
        $args['post_parent'] = $id;
        $args['numberposts'] = -1;
    }
 
    $images = get_posts( $args );

    foreach ( $images as $key => $image ) {

        if( $key == 0 ){
            $image_thumb_data = wp_get_attachment_image_src( $image->ID, 'full' );
        }
        else{
            $image_thumb_data = wp_get_attachment_image_src( $image->ID );
        }

        $image_alt = get_post_meta( $image->ID, '_wp_attachment_image_alt', true );
        $image_full_data = wp_get_attachment_image_src( $image->ID, 'full' );
        
        $image_tag .= "<li><figure itemprop='associatedMedia' itemscope itemtype='http://schema.org/ImageObject' data-index='{$key}'>";
        $image_tag .= "<a href='{$image_full_data[0]}' itemprop='contentUrl' data-size='{$image_full_data[1]}x{$image_full_data[2]}'>";
        $image_tag .= "<img class='img-responsive' src='{$image_thumb_data[0]}' width='{$image_thumb_data[1]}' height='{$image_thumb_data[2]}' itemprop='thumbnail' alt='{$image_alt}' />";
        $image_tag .= "</a></figure></li>";

    }
    
    echo $image_tag;

}

?>