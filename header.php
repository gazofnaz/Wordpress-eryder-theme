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
        <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/photoswipe.css">
        <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/default-skin/default-skin.css">
        <!--Uncomment this to use a favicon.ico in the theme directory: -->
        <!--<link rel="SHORTCUT ICON" href="<?php bloginfo('template_directory'); ?>/favicon.ico"/>-->

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <?php wp_head(); ?>
    </head>

<body <?php body_class(); ?>>
<header>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <nav class="navbar navbar-default">
                    <div class="navbar-header"> 
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span> 
                            <span class="icon-bar"></span> 
                            <span class="icon-bar"></span> 
                            <span class="icon-bar"></span> 
                        </button> 
                        
                            <a class="navbar-brand" href="<?php bloginfo('url'); ?>">
                                <span class="glyphicon glyphicon glyphicon-home"></span> 
                                <?php bloginfo('name'); ?> - <small><?php bloginfo('description'); ?></small>
                            </a>
                        
                    </div> 
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
<?php
                    $args = array(  'menu' => 'top_menu',
                                    'depth' => 2,
                                    'container' => false,
                                    'menu_class' => 'nav navbar-nav navbar-right',
                                    'walker' => new wp_bootstrap_navwalker());

                    wp_nav_menu($args);
?>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>

<!-- See footer for closures -->
<div class="container">