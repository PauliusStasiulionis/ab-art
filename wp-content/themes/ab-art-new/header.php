<?php

/**
 * Description of header
 *
 * @author Paulius Stasiulionis
 * @since 2014-10-26
 * @version 2014-10-26
 */
?>
<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
    
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'ab-art-new' ), max( $paged, $page ) );

	?></title>
    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri();?>/images/favicon.ico">
    <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri();?>/images/apple-touch-60x60.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_template_directory_uri();?>/images/apple-touch-76x76.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_template_directory_uri();?>/images/apple-touch-120x120.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_template_directory_uri();?>/images/apple-touch-152x152.png">
    <script src="<?php echo get_template_directory_uri(); ?>/js/script.js"></script>
    <?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
    <?php wp_head(); ?>
    <script src="<?php echo get_template_directory_uri(); ?>/js/script.js"></script>
    
</head>    
<body <?php body_class(); ?>>
    <div id="wrapper">
        <div id="container">
            <div id="menubar">
                <ul id="lang-flags"><?php pll_the_languages(array('show_flags' => 1, 'show_names' => 0));?></ul>
                <div id="logo"></div>
                <?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); ?>     
            </div>
          
            

    
