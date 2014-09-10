<?php

/* sidebar */
if ( function_exists('register_sidebar') )
    register_sidebar(array('description' => 'Left Sidebar'));

/* nav menus */
if ( function_exists( 'register_nav_menu' ) ) {
	register_nav_menu('header_nav', __('Header Navigation Menu'));
	register_nav_menu('footer_nav', __('Footer Navigation Menu'));	
}

/* Adds class="active" to currently active menu item */
add_filter( 'nav_menu_css_class' , 'special_nav_class' , 10 , 2 );

function special_nav_class( $classes, $item ){
     if( in_array('current-menu-item', $classes) ){
             $classes[] = 'active ';
     }
     return $classes;
}

/* automatic feed links */
add_theme_support('automatic-feed-links');

?>