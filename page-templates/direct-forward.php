<?php
/*
Template Name: Redirect Forward
@package WordPress
*/
__( 'Redirect Forward', 'wpbasetheme' );
$pagekids = get_pages("child_of=".$post->ID."&sort_column=menu_order");
if ($pagekids) {
	$firstchild = $pagekids[0];
	wp_redirect(get_permalink($firstchild->ID));
} else {?>

<?php get_header(); ?>

<?php get_template_part( 'content', 'page'); ?>

<?php get_footer(); ?>

<?php } ?>