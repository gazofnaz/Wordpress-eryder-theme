<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>
            <?php wp_title(' - ', true, 'right'); ?>
            <?php bloginfo('name'); ?>
        </title>
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
        <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/custom.css">
        <!--Uncomment this to use a favicon.ico in the theme directory: -->
        <!--<link rel="SHORTCUT ICON" href="<?php bloginfo('template_directory'); ?>/favicon.ico"/>-->

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
        <?php wp_head(); ?>
    </head>

<body <?php body_class(); ?>>
<header>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1>
                    <a href="<?php bloginfo('url'); ?>">
                        <?php bloginfo('name'); ?> - <?php bloginfo('description'); ?>
                    </a>
                </h1>
                <nav>
                <?php
                        $args = array( 'menu'               => 'main', 
                                       'container_class'    => 'navbar navbar-default', 
                                       'container'          => 'div', 
                                       'theme_location'     => 'primary-menu',
                                       'items_wrap'         => '<ul class="nav navbar-nav">%3$s</ul>');
                        wp_nav_menu($args);
                ?>
                </nav>
            </div>
        </div>
    </div>
</header>

<!-- See footer for closures -->
<div class="container">
    <div class="row">
        <div class="col-sm-12">