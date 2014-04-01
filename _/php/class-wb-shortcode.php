<?php
/*
	Contains shortcodes:
	gallery
*/
class WB_Shortcode {

	public static function initialize() {
		add_shortcode('gallery', array( __CLASS__, 'gallery') );
	}

	public static function gallery( $attr ) {
		$attr['itemtag']   	= 'div';
		$attr['icontag']    = 'div';
		$attr['captiontag']	= 'figure';
		return gallery_shortcode($attr);
	}

}