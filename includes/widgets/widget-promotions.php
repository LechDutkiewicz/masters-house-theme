<?php
if ( !defined( 'ABSPATH' ) )
	exit( 'No direct script access allowed' ); // Exit if accessed directly

/**
 * Widget Post
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

/**
 * Archives widget class.
 *
 * @since 1.0
 */
class TSM_Promotions_Posts extends WP_Widget {

	/**
	 * Set up the widget's unique name, ID, class, description, and other options.
	 *
	 * @since 1.2.0
	 */
	function __construct() {

		/* Set up the widget options. */
		$widget_options = array(
			'classname' => 'tsm-promotions-widget',
			'description' => esc_html__( 'Show latest running promotion', 'bon' )
			);

		/* Set up the widget control options. */
		$control_options = array(
			);

		/* Create the widget. */
		parent::__construct(
				'tsm-promotions', // $this->id_base
				'TSM Promotions', // $this->name
				$widget_options, // $this->widget_options
				$control_options  // $this->control_options
				);
	}

	/**
	 * Outputs the widget based on the arguments input through the widget controls.
	 *
	 * @since 0.6.0
	 */
	function widget( $sidebar, $instance ) {

		if ( bon_get_option( 'home_promotion' ) ) {

			extract( $sidebar );

			/* Set the $args for wp_get_archives() to the $instance array. */
			$args = $instance;
			$button_color = bon_get_option( 'search_button_color', 'red' );

			/* Overwrite the $echo argument and set it to false. */
			$args['echo'] = false;

			/* Output the theme's $before_widget wrapper. */
			echo $before_widget;

			/* If a title was input by the user, display it. */
			if ( !empty( $instance['title'] ) )
				echo $before_title . apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) . $after_title;

			$args = array(
				'post_status' => 'publish',
				'post_type' => 'promotions',
				'posts_per_page' => 1,
				'order' => 'ASC',
				'orderby' => 'date',
				'ignore_sticky_posts' => true,
				);

			$promotions_query = get_posts( $args );

			foreach ( $promotions_query as $post ) {
				$thumb_id = get_post_thumbnail_id( $post->ID );
				$thumb_full = wp_get_attachment_image_src( $thumb_id, 'full' );
				?>

				<div class="item clear">
					<header class="entry-header">
						<?php
						if ( current_theme_supports( 'get-the-image' ) && get_post_field( 'post_content', $post->ID ) ) {
							if ( $_SESSION['layoutType'] === 'mobile' ) {
								get_the_image( array( 'post_id' => $post->ID, 'size' => 'mobile_regular', 'image_scan' => true ) );
							} else {
								get_the_image( array( 'post_id' => $post->ID, 'size' => 'full', 'image_scan' => true ) );
							}
						} else if ( current_theme_supports( 'get-the-image' ) && !get_post_field( 'post_content', $post->ID ) ) { ?>
						<div class="zoom-img">
							<a href="<?php echo $thumb_full[0]; ?>">
								<?php
								if ( $_SESSION['layoutType'] === 'mobile' ) {
									get_the_image( array( 'post_id' => $post->ID, 'size' => 'mobile_regular', 'image_scan' => true, 'link_to_post' => false ) );
								} else {
									get_the_image( array( 'post_id' => $post->ID, 'size' => 'full', 'image_scan' => true, 'link_to_post' => false ) );
								} ?>
							</a>
						</div>
						<?php } ?>
					</header>
					<?php if ( get_post_field( 'post_content', $post->ID ) ) { ?>
					<div class="item-content padding-medium top">
						<a href="<?php echo get_the_permalink( $post->ID ); ?>" class="button flat <?php echo $button_color; ?> radius" title="<?php echo get_the_title( $post->ID ); ?>"><?php _e( 'Read more', 'bon' ); ?></a>
					</div>
					<?php } ?>
				</div>

				<?php }

				/* Close the theme's widget wrapper. */
				echo $after_widget;

			} else {
				return;
			}
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
			'title' => esc_attr__( 'Special offer', 'bon' ),
			);

		/* Merge the user-selected arguments with the defaults. */
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>

		<div class="bon-toolkit-widget-controls">
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'bon-toolkit' ); ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
			</p>
		</div>
		<?php
	}

}
?>