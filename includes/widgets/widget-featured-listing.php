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
class Shandora_Featured_Listing_Widget extends WP_Widget {

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
		parent::__construct(
				'shandora-featured-listing', // $this->id_base
				'Shandora Featured Listing', // $this->name
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
		?>

		<div class="row">
			<div class="column large-12 featured-listing-carousel">
				<?php
				$prefix = bon_get_prefix();
				$query = array(
					'post_type' => 'listing',
					'posts_per_page' => $args['limit'],
					'meta_query' => array(
						array(
							'key' => $prefix . 'listing_featured',
							'value' => true,
							'compare' => '=',
							)
						)
					);
				$featured_query = new WP_Query( $query );

				if ( $featured_query->have_posts() ) : $i = 0;
				?>
				
				<div id="<?php echo $this->id; ?>-nav" class="featured-listing-nav">
				</div>
				<div id="<?php echo $this->id; ?>-slider" class="flexslider" data-animation="slide" data-control-nav="false" data-controls-container="<?php echo $this->id; ?>-nav">

					<ul class="slides">

						<?php while ( $featured_query->have_posts() ) : $featured_query->the_post();
						?>
						<?php if ( $i == 0 ) : ?>
						<li>
						<?php endif; ?>
						
						<?php bon_get_template_part( 'block', 'widget-single-listing' ); ?>

						<?php
						$i++;
						if ( $i == $args['per_slide'] ) : $i = 0;
						?>
					</li>
				<?php endif; ?>
				<?php
				endwhile;
				?>
				<?php if ( $i > 0 ) : ?>
			</li>
		<?php endif; ?>
	</ul>

</div>

<?php
else:

	echo '<p>' . __( 'No property listing were found', 'bon' ) . '</p>';

endif;
wp_reset_query();
?>
</div>
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

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['limit'] = strip_tags( $new_instance['limit'] );
		$instance['per_slide'] = intval( $new_instance['per_slide'] );

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
			'title' => esc_attr__( 'Featured Listing', 'bon' ),
			'limit' => 10,
			'per_slide' => 3,
			);

		/* Merge the user-selected arguments with the defaults. */
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>

		<div class="bon-widget-controls">
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><code><?php _e( 'Title:', 'bon' ); ?></code></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'limit' ); ?>"><code><?php _e( 'Number of Posts', 'bon' ); ?></code></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'limit' ); ?>" name="<?php echo $this->get_field_name( 'limit' ); ?>" value="<?php echo esc_attr( $instance['limit'] ); ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'per_slide' ); ?>"><code><?php _e( 'Post per slide:', 'bon' ); ?></code></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'per_slide' ); ?>" name="<?php echo $this->get_field_name( 'per_slide' ); ?>" value="<?php echo esc_attr( $instance['per_slide'] ); ?>" />
			</p>
		</div>
		<?php
	}

}
?>