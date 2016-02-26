<?php
if ( !defined( 'ABSPATH' ) )
	exit( 'No direct script access allowed' ); // Exit if accessed directly

/**
 * Widget Archive
 *
 *
 *
 * @author		Hermanto Lim
 * @copyright	Copyright (c) Hermanto Lim
 * @link		http://bonfirelab.com
 * @since		Version 1.0
 * @package 	BonFramework
 * @category 	Widgets
 *
 *
 */

/**
 * Archives widget class.
 *
 * @since 1.0
 */
class Shandora_Related_Cottages_Widget extends WP_Widget {

	/**
	 * Set up the widget's unique name, ID, class, description, and other options.
	 *
	 * @since 1.2.0
	 */
	function __construct() {

		/* Set up the widget options. */
		$widget_options = array(
			'classname' => 'featured-listing',
			'description' => esc_html__( 'Show featured property listing.', 'bon' )
			);

		/* Set up the widget control options. */
		$control_options = array(
			);

		/* Create the widget. */
		$this->WP_Widget(
				'shandora-related-cottages', // $this->id_base
				'Shandora Related Cottages', // $this->name
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

		if ( is_singular( 'listing' ) ) {

			extract( $sidebar );

			/* Set the $args for wp_get_archives() to the $instance array. */
			$args = $instance;

			/* Overwrite the $echo argument and set it to false. */
			$args['echo'] = false; ?>

			<?php /* Output the theme's $before_widget wrapper. */
			echo $before_widget; ?>

			<?php /* If a title was input by the user, display it. */
			echo $before_title . apply_filters( 'widget_title', __( 'You may also like', 'bon' ), $instance, $this->id_base ) . $after_title;
			global $post;
			$related_query = shandora_get_related_query( $post->ID );
			?>
			<ul class="listings related mobile-block-grid-1">

				<?php foreach ( $related_query as $post ) { ?>

				<li class="<?php echo extra_class($post->ID); ?>">
					<article class="hover-shadow">
						<?php bon_get_template_part( 'block', 'widget-single-listing' ); ?>
					</article>
				</li>

				<?php } ?>

			</ul>

			<?php
			/* Close the theme's widget wrapper. */
			echo $after_widget; ?>

			<?php }

		}

	/**
	 * Updates the widget control options for the particular instance of the widget.
	 *
	 * @since 0.6.0
	 */
	function update( $new_instance, $old_instance ) {

		$instance = $new_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );

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
			'title' => esc_attr__( 'You may also like', 'bon' ),
			);

		/* Merge the user-selected arguments with the defaults. */
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>

		<div class="bon-widget-controls">
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><code><?php _e( 'Title:', 'bon' ); ?></code></label>
				<input disabled type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
			</p>
		</div>
		<?php
	}

}
?>