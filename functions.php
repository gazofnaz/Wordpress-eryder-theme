<?php

/* sidebar */
if ( function_exists('register_sidebar') ){
    register_sidebar(array('description' => 'Left Sidebar'));
}
/*---*/

/* nav menus */
if ( function_exists( 'register_nav_menu' ) ) {
	register_nav_menu('header_nav', __('Header Navigation Menu'));
	register_nav_menu('footer_nav', __('Footer Navigation Menu'));	
}
/*---*/

/* Adds class="active" to currently active menu item */
add_filter( 'nav_menu_css_class' , 'special_nav_class' , 10 , 2 );

function special_nav_class( $classes, $item ){
     if( in_array('current-menu-item', $classes) ){
             $classes[] = 'active ';
     }
     return $classes;
}
/*---*/

/* automatic feed links */
add_theme_support('automatic-feed-links');
/*---*/

/* Javascript Includes for front end */
function load_all_scripts() {

    /* jQuery is included with wordpress by default */

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

    foreach( get_post_custom()['wpcf-post-image'] as $key => $img_src ){
        
        // allow for limited number to be returned
        if( $limit &&  $key +1 > $limit ){
            continue;
        }

        $post_image_src[] = $img_src; 

    }

    return $post_image_src;

}

/** Get Image Variation from String
 *
 * Cheap way to get image variations from a basic string (e.g. post field value)
 *
 * Takes this: img.src.jpg, -150x150
 * Returns this: img.src-150x150.jpg
 *
 */
function getImageVariaton( $img_src, $variation ){
    $ext = pathinfo($img_src, PATHINFO_EXTENSION);
    $filename = str_replace( '.'.$ext, '', $img_src ).$variation.'.'.$ext;
    return ( $filename );
}
/*---*/
?>