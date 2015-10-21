<?php

class Custom_Image_Widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'custom-image-widget',
			'Custom Image Widget',
			array( 'description' => 'Displays custom image that zooms to full screen when clicked' )
			);
	}

	public function widget( $sidebar, $instance ) {
		extract( $sidebar );

		/* Set the $args for wp_get_archives() to the $instance array. */
		$args = $instance;

		/* Overwrite the $echo argument and set it to false. */
		$args['echo'] = false;

		/* Output the theme's $before_widget wrapper. */
		echo $before_widget;

		/* If a title was input by the user, display it. */
		if ( !empty( $instance['title'] ) )
			echo $before_title . apply_filters( 'widget_title',  $instance['title'], $instance, $this->id_base ) . $after_title;

		?>
		<div class="zoom-img">
			<a href="<?php echo $instance['image_zoom_uri']; ?>">
				<img src="<?php echo $instance['image_uri']; ?>" title="<?php echo $instance['title']; ?>" alt="<?php echo $instance['title']; ?>" class="auto">
			</a>
		</div>
		<?php
		/* Close the theme's widget wrapper. */
		echo $after_widget;
	}

	/**
	 * Updates the widget control options for the particular instance of the widget.
	 *
	 * @since 0.6.0
	 */
	function update( $new_instance, $old_instance ) {

		$instance = $new_instance;

		$instance['title']  = strip_tags( $new_instance['title'] );
		$instance['image_uri']  = strip_tags( $new_instance['image_uri'] );
		$instance['image_zoom_uri']  = strip_tags( $new_instance['image_zoom_uri'] );

		return $instance;
	}

	/**
	 * Displays the widget control options in the Widgets admin screen.
	 *
	 * @since 0.6.0
	 */

	public function form( $instance ) {

		/* Set up the default form values. */
		$defaults = array(
			'title'           => esc_attr__( 'Display custom image', 'bon' ),
			);

		/* Merge the user-selected arguments with the defaults. */
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'bon' ); ?></label><br />
			<input type="text" name="<?php echo $this->get_field_name( 'title' ); ?>" id="<?php echo $this->get_field_id( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'image_uri' ); ?>"><?php _e( 'Image', 'bon' ); ?></label><br />
			<input type="text" class="img" name="<?php echo $this->get_field_name( 'image_uri' ); ?>" id="<?php echo $this->get_field_id( 'image_uri' ); ?>" value="<?php echo $instance['image_uri']; ?>" />
			<input type="button" class="select-img" value="Select Image" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'image_zoom_uri' ); ?>"><?php echo __( 'Image', 'bon' ) . ' ' . __( 'zoomed', 'bon' ); ?></label><br />
			<input type="text" class="img" name="<?php echo $this->get_field_name( 'image_zoom_uri' ); ?>" id="<?php echo $this->get_field_id( 'image_zoom_uri' ); ?>" value="<?php echo $instance['image_zoom_uri']; ?>" />
			<input type="button" class="select-img" value="Select Image" />
		</p>
		<?php
	}

}

// end class
// init the widget
add_action( 'widgets_init', create_function( '', 'return register_widget("Custom_Image_Widget");' ) );

// queue up the necessary js
function hrw_enqueue( $hook ) {

	if ( $hook != 'widgets.php' )
		return;

	wp_enqueue_style( 'thickbox' );
	wp_enqueue_script( 'media-upload' );
	wp_enqueue_script( 'thickbox' );
	// I also changed the path, since I was using it directly from my theme and not as a plugin
	wp_enqueue_script( 'hrw', get_template_directory_uri() . '/assets/js/libs/custom-image.js', null, null, true );
}

add_action( 'admin_enqueue_scripts', 'hrw_enqueue' );
