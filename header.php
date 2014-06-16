<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <title><?php wp_title( '|', true, 'right'); ?></title> 
    
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="wrapper">
	<header class="page-header" role="banner">
		<div class="container">
			<div class="header-container">
				<a class="site-name" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<h1><?php bloginfo( 'name' ); ?></h1>
				</a>
				
				<div id="mobile-nav-btn"><span></span><span></span><span></span></div>
				
				<nav id="nav" role="navigation" class="main-menu">
					<?php wp_nav_menu( array( 'theme_location' => 'main-menu', 'container' => false, 'depth' => 1 ) ); ?>
				</nav>
			</div>
		</div>
	</header>

	<div class="page-content">