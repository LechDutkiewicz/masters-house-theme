<?php if ( ! defined( 'ABSPATH' ) ) exit('No direct script access allowed'); // Exit if accessed directly

/**
 * Widget Contact Form
 *
 *
 *
 * @author		Hermanto Lim
 * @copyright	Copyright (c) Hermanto Lim
 * @link		http://bonfirelab.com
 * @since		Version 1.0
 * @package 	Bon Toolkit
 * @category 	Widgets
 *
 *
*/ 

add_action( 'widgets_init', 'load_newsletter_form' );

function load_newsletter_form() {
	register_widget( 'Newsletter_Form' );
}

class Newsletter_Form extends WP_Widget {

	/**
	 * Set up the widget's unique name, ID, class, description, and other options.
	 *
	 * @since 1.2.0
	 */
	function __construct() {

		/* Set up the widget options. */
		$widget_options = array(
			'classname'   => 'newsletterform-widget',
			'description' => esc_html__( 'Widget to show Newsletter Form.', 'bon' )
			);

		/* Set up the widget control options. */
		$control_options = array();

		/* Create the widget. */
		$this->WP_Widget(
			'newsletterform',               // $this->id_base
			__( 'Widget Newsletter.', 'bon' ), // $this->name
			$widget_options,                 // $this->widget_options
			$control_options                 // $this->control_options
			);
	}

	/**
	 * Outputs the widget based on the arguments input through the widget controls.
	 *
	 * @since 1.0
	 */
	function widget( $sidebar, $instance ) {
		extract( $sidebar );

		/* Set the $args for wp_get_archives() to the $instance array. */
		$args = $instance;

		/* Overwrite the $echo argument and set it to false. */
		$args['echo'] = false;

		if ( is_user_logged_in() && !isset( $_COOKIE["subscribed"] ) ) {

			/* Output the theme's $before_widget wrapper. */
			echo $before_widget;

			/* If a title was input by the user, display it. */
			if ( !empty( $instance['title'] ) )
				echo $before_title . apply_filters( 'widget_title',  $instance['title'], $instance, $this->id_base ) . $after_title;

			$o = apply_filters( 'bon_toolkit_contact_form_widget_filter', '', bon_get_option( 'newsletter_email', get_bloginfo( 'admin_email' ) ), bon_get_option( 'search_button_color', 'red' ) );

			if($o != '') {
				echo $o;
			} else {
				$o = bon_toolkit_get_contact_form($args['email_address'], bon_get_option( 'search_button_color', 'red' ));
				echo $o;
			}


			/* Close the theme's widget wrapper. */
			echo $after_widget;

		}

	}

	/**
	 * Updates the widget control options for the particular instance of the widget.
	 *
	 * @since 0.6.0
	 */
	function update( $new_instance, $old_instance ) {

		$instance = $new_instance;

		$instance['title']  = strip_tags( $new_instance['title'] );

		return $instance;
	}

	/**
	 * Displays the widget control options in the Widgets admin screen.
	 *
	 * @since 0.6.0
	 */
	function form( $instance ) {

		/* Set up the default form values. */
		$defaults = array(
			'title'           => esc_attr__( 'Subscribe to our newsletter', 'bon' ),
			);


		/* Merge the user-selected arguments with the defaults. */
		$instance = wp_parse_args( (array) $instance, $defaults );

		?>

		<div class="bon-toolkit-widget-controls">
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><code><?php _e( 'Title:', 'bon-toolkit' ); ?></code></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
			</p>
		</div>
		<?php
	}
}

?>