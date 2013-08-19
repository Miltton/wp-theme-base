<?php 
/**
*  Base for theme widgets
*/
class Widget_Base extends WP_Widget
{
	public function __construct() {
		parent::__construct(
			'widget_id',
			'Widget Base Name',
			array(
				'description' => 'Widget works just like that.'
				) 
			);
	}

	public function form( $instance ) {
		// Outputs the options form
	}

	public function update( $new_instance, $old_instance ) {
		// Widget options to be saved
	}

	public function widget( $args, $instance ) {
		// How widget looks like
	}
}

register_widget( 'Widget_Base' );
?>