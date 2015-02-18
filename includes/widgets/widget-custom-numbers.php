<?php
if ( !defined( 'ABSPATH' ) )
	exit( 'No direct script access allowed' ); // Exit if accessed directly

/**
 * Widget Archive
 *
 *
 *
 * @author		Lech Dutkiewicz
 * @copyright	Copyright (c) Lech Dutkiewicz
 * @link		http://techsavvymarketers.pl
 * @since		Version 1.0
 * @category 	Widgets
 *
 *
 */

/**
 * Archives widget class.
 *
 * @since 1.0
 */
class Widget_Custom_Numbers extends WP_Widget {

	/**
	 * Set up the widget's unique name, ID, class, description, and other options.
	 *
	 * @since 1.2.0
	 */
	function __construct() {

		/* Set up the widget options. */
		$widget_options = array(
			'classname' => 'custom-numbers',
			'description' => esc_html__( 'Numbers with descriptions to display.', 'bon' )
		);

		/* Set up the widget control options. */
		$control_options = array(
		);

		/* Create the widget. */
		$this->WP_Widget(
				'widget-custom-numbers', // $this->id_base
				__( 'Widget Custom Numbers', 'bon' ), // $this->name
				$widget_options, // $this->widget_options
				$control_options  // $this->control_options
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

		/* Output the theme's $before_widget wrapper. */
		echo $before_widget;

		/* If a title was input by the user, display it. */
		if ( !empty( $instance['title'] ) )
			echo $before_title . apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) . $after_title;

		$columns = count( $instance['fields'] ) % 2 + 2;
		$counter = 1;
		?>
		<?php foreach ( $instance['fields'] as $field ) : ?>
			<?php if ( $counter % $columns === 1 ) : ?>
				<div class="row">
				<?php endif; ?>
				<div class="column large-<?php echo 12 / $columns; ?> text-center">
					<span class="widget-custom-number brick"><?php echo $field['value']; ?></span>
					<span class="widget-custom-numbers-text"><?php echo $field['desc']; ?></span>
				</div>
				<?php if ( $counter % $columns === 0 ) : ?>
				</div>
			<?php endif; ?>
			<?php $counter += 1; ?>
		<?php endforeach; ?>
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
		$instance = $old_instance;
		$instance['title'] = esc_html( $new_instance['title'] );

		$instance['fields'] = array();

		if ( isset( $new_instance['fields'] ) ) {
			$fields_update_counter = 0;
			foreach ( $new_instance['fields'] as $field ) {
				foreach ( $field as $key => $value ) {
					if ( '' !== trim( $value ) ) {
						$instance['fields'][$fields_update_counter][$key] = $value;
					}
				}
				$fields_update_counter += 1;
			}
		}

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
			'title' => esc_attr__( 'Our Work', 'bon' ),
		);

		/* Merge the user-selected arguments with the defaults. */
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>

		<div class="bon-widget-controls">
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><code><?php _e( 'Title:', 'bon' ); ?></code></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
			</p>
			<?php
			$fields = isset( $instance['fields'] ) ? $instance['fields'] : array();
			$field_num = count( $fields );
			$fields[$field_num] = array( 'value' => '', 'desc' => '' );
			$fields_html = array();
			$fields_counter = 0;

			foreach ( $fields as $field ) {
				foreach ( $field as $key => $value ) {
					?>
					<label for="<?php echo $this->get_field_name( 'fields' ) . "[$fields_counter][$key]"; ?>"><code><?php echo $key; ?></code></label>
					<input type="<?php echo ($key === 'value') ? 'number' : 'text'; ?>" id="<?php echo $this->get_field_name( 'fields' ) . "[$fields_counter][$key]"; ?>" name="<?php echo $this->get_field_name( 'fields' ) . "[$fields_counter][$key]"; ?>" value="<?php echo $value; ?>" class="widefat">
					<?php
				}
				$fields_counter += 1;
			}
			?>
		</div>

		<?php
	}

}
?>