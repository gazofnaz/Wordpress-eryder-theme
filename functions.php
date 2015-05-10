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

/** @todo create gallery plugin */
remove_shortcode( 'gallery' );
add_shortcode( 'gallery', 'parse_gallery_shortcode' );

/** @todo Build a framework just like wordpress but not shit. */
function parse_gallery_shortcode( $atts ) {
 
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

    $image_tag = '';
    $image_tag .= "<div class='picture' itemscope itemtype='http://schema.org/ImageGallery'><div class='row'>";

    $first_image = $images[0];

    $first_image_alt = get_post_meta( $first_image->ID, '_wp_attachment_image_alt', true );
    $first_image_full_data = wp_get_attachment_image_src( $first_image->ID, 'full' );
    $first_image_thumb_data = wp_get_attachment_image_src( $first_image->ID, 'large-thumb' );

    $image_tag .= <<<EOT
<div class='col-md-5'>
    <figure itemprop='associatedMedia' itemscope itemtype='http://schema.org/ImageObject' data-index='0'>
        <a href='{$first_image_full_data[0]}' itemprop='contentUrl' data-size='{$first_image_full_data[1]}x{$first_image_full_data[2]}'>
            <img class="img-responsive bottom-buffer" src='{$first_image_thumb_data[0]}' width='{$first_image_thumb_data[1]}' height='{$first_image_thumb_data[2]}' itemprop='thumbnail' alt='{$first_image_alt}' />
        </a>
    </figure>
</div>
EOT;

    $image_tag .= "<div class='col-md-7'>";
    foreach ( $images as $key => $image ) {


        if( $key != 0 ){
            $image_thumb_data = wp_get_attachment_image_src( $image->ID );
            $image_alt = get_post_meta( $image->ID, '_wp_attachment_image_alt', true );
            $image_full_data = wp_get_attachment_image_src( $image->ID, full );
            $image_tag .= <<<EOT
<figure class="inline" itemprop='associatedMedia' itemscope itemtype='http://schema.org/ImageObject' data-index='{$key}'>
    <a href='{$image_full_data[0]}' itemprop='contentUrl' data-size='{$image_full_data[1]}x{$image_full_data[2]}'>
        <img class="right-buffer bottom-buffer" src='{$image_thumb_data[0]}' width='{$image_thumb_data[1]}' height='{$image_thumb_data[2]}' itemprop='thumbnail' alt='{$image_alt}' />
    </a>
</figure>
EOT;
        }
    }

    $image_tag .= "</div>";
    $image_tag .= "</div></div>";
    
    return $image_tag;

}
/*---*/
/* Custom theme configuration. Add new image size */
add_action( 'after_setup_theme', 'eryder_theme_setup' );
function eryder_theme_setup() {
    // custom auto large thumbnail size
    add_image_size( 'large-thumb', 450, 450, array( 'center', 'center' ) );
}
/*---*/
/* Allow post title to be inserted into post content using shortcode */
function shortcode_title( ){
    $the_title = get_the_title();
    $the_title = sprintf( '<h1>%s</h1>', $the_title );
    return $the_title;
}
add_shortcode( 'page_title', 'shortcode_title' );
/*---*/
/** hide admin bar from front end */
add_filter( 'show_admin_bar', '__return_false' );
/*---*/

function dimox_breadcrumbs() {

    /* === OPTIONS === */
    $text['home']     = 'Home'; // text for the 'Home' link
    $text['category'] = '%s'; // text for a category page
    $text['search']   = 'Search Results for "%s" Query'; // text for a search results page
    $text['tag']      = 'Posts Tagged "%s"'; // text for a tag page
    $text['author']   = 'Articles Posted by %s'; // text for an author page
    $text['404']      = 'Error 404'; // text for the 404 page

    $show_current   = 1; // 1 - show current post/page/category title in breadcrumbs, 0 - don't show
    $show_on_home   = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
    $show_home_link = 0; // 1 - show the 'Home' link, 0 - don't show
    $show_title     = 1; // 1 - show the title for the links, 0 - don't show
    $delimiter      = ''; // delimiter between crumbs
    $before         = '<li class="active">'; // tag before the current crumb
    $after          = '</li>'; // tag after the current crumb
    /* === END OF OPTIONS === */

    global $post;
    $home_link    = home_url('/');
    $link_before  = '<li>';
    $link_after   = '</li>';
    $link         = $link_before . '<a href="%1$s">%2$s</a>' . $link_after;
    $parent_id    = $parent_id_2 = $post->post_parent;
    $frontpage_id = get_option('page_on_front');

    if (is_home() || is_front_page()) {

        if ($show_on_home == 1) echo '<ol class="breadcrumb"><a href="' . $home_link . '">' . $text['home'] . '</a></div>';

    } else {

        echo '<ol class="breadcrumb">';
        if ($show_home_link == 1) {
            echo '<a href="' . $home_link . '" rel="v:url" property="v:title">' . $text['home'] . '</a>';
            if ($frontpage_id == 0 || $parent_id != $frontpage_id) echo $delimiter;
        }

        if ( is_category() ) {
            $this_cat = get_category(get_query_var('cat'), false);
            if ($this_cat->parent != 0) {
                $cats = get_category_parents($this_cat->parent, TRUE, $delimiter);
                if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
                $cats = str_replace('<a', $link_before . '<a' , $cats);
                $cats = str_replace('</a>', '</a>' . $link_after, $cats);
                if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
                echo $cats;
            }
            if ($show_current == 1) echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;

        } elseif ( is_search() ) {
            echo $before . sprintf($text['search'], get_search_query()) . $after;

        } elseif ( is_day() ) {
            echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
            echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
            echo $before . get_the_time('d') . $after;

        } elseif ( is_month() ) {
            echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
            echo $before . get_the_time('F') . $after;

        } elseif ( is_year() ) {
            echo $before . get_the_time('Y') . $after;

        } elseif ( is_single() && !is_attachment() ) {
            if ( get_post_type() != 'post' ) {
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                printf($link, $home_link . $slug['slug'] . '/', $post_type->labels->singular_name);
                if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;
            } else {
                $cat = get_the_category(); $cat = $cat[0];
                $cats = get_category_parents($cat, TRUE, $delimiter);
                if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
                $cats = str_replace('<a', $link_before . '<a', $cats);
                $cats = str_replace('</a>', '</a>' . $link_after, $cats);
                if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
                echo $cats;
                if ($show_current == 1) echo $before . get_the_title() . $after;
            }

        } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
            $post_type = get_post_type_object(get_post_type());
            echo $before . $post_type->labels->singular_name . $after;

        } elseif ( is_attachment() ) {
            $parent = get_post($parent_id);
            $cat = get_the_category($parent->ID); $cat = $cat[0];
            if ($cat) {
                $cats = get_category_parents($cat, TRUE, $delimiter);
                $cats = str_replace('<a', $link_before . '<a', $cats);
                $cats = str_replace('</a>', '</a>' . $link_after, $cats);
                if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
                echo $cats;
            }
            printf($link, get_permalink($parent), $parent->post_title);
            if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;

        } elseif ( is_page() && !$parent_id ) {
            if ($show_current == 1) echo $before . get_the_title() . $after;

        } elseif ( is_page() && $parent_id ) {
            if ($parent_id != $frontpage_id) {
                $breadcrumbs = array();
                while ($parent_id) {
                    $page = get_page($parent_id);
                    if ($parent_id != $frontpage_id) {
                        $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
                    }
                    $parent_id = $page->post_parent;
                }
                $breadcrumbs = array_reverse($breadcrumbs);
                for ($i = 0; $i < count($breadcrumbs); $i++) {
                    echo $breadcrumbs[$i];
                    if ($i != count($breadcrumbs)-1) echo $delimiter;
                }
            }
            if ($show_current == 1) {
                if ($show_home_link == 1 || ($parent_id_2 != 0 && $parent_id_2 != $frontpage_id)) echo $delimiter;
                echo $before . get_the_title() . $after;
            }

        } elseif ( is_tag() ) {
            echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;

        } elseif ( is_author() ) {
            global $author;
            $userdata = get_userdata($author);
            echo $before . sprintf($text['author'], $userdata->display_name) . $after;

        } elseif ( is_404() ) {
            echo $before . $text['404'] . $after;

        } elseif ( has_post_format() && !is_singular() ) {
            echo get_post_format_string( get_post_format() );
        }

        if ( get_query_var('paged') ) {
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
            echo __('Page') . ' ' . get_query_var('paged');
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
        }

        echo '</ol><!-- .breadcrumbs -->';

    }
} // end dimox_breadcrumbs()


?>