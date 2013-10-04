<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]> <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    
    <title><?php wp_title( '|', true, 'right'); ?><?php bloginfo( 'name' ); ?></title> 
    <meta name="description" content="<?php bloginfo( 'description' ); ?>">
    
    <meta name="viewport" content="width=device-width">

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="wrapper">
	<header class="page-header" role="banner">
		<div class="container">
			<div class="header-container">
				<a class="site-name" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display') ); ?>" rel="home">
					<h1><?php bloginfo( 'name' ); ?></h1>
				</a>
				
				<div id="mobile-nav-btn"><span></span><span></span><span></span></div>
				
				<nav id="nav" role="navigation" class="main-menu">
					<?php wp_nav_menu( array( 'container' => false, 'depth' => 1 ) ); ?>
				</nav>
			</div>
		</div>
	</header>

	<div class="page-content">