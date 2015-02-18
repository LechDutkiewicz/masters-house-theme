<?php
$slider_post_per_page = 1;
$post_in = array();
$visited = check_cookie( 'visited' );

if ( $visited ) {
	$meta_query[] = array(
		'key' => bon_get_prefix() . 'slider_returning',
		'value' => 2,
		'compare' => '>=',
	);
} else {
	$meta_query[] = array(
		'key' => bon_get_prefix() . 'slider_returning',
		'value' => 2,
		'compare' => '<=',
	);
}

global $post;
$slideshow_ids = shandora_get_meta( $post->ID, 'slideshow_ids' );
$slideshow_type = shandora_get_meta( $post->ID, 'slideshow_type' );
$slideshow_type = ($slideshow_type != '' ) ? $slideshow_type : 'full';
if ( !empty( $slideshow_ids ) ) {
	$post_in = explode( ',', $slideshow_ids );
}

$loop = new WP_Query(
		array(
	'post_type' => 'slider',
	'posts_per_page' => $slider_post_per_page,
	'post_status' => 'publish',
	'orderby' => 'rand',
	'post__in' => $post_in,
	'meta_query' => $meta_query
		)
);
?>

<?php if ( $loop->have_posts() ) : ?>
	<div id="slider-container" class="container <?php echo $slideshow_type; ?>">
		<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

			<?php $GLOBALS['home-img'] = $post->ID; ?>

			<?php bon_get_template_part( 'block', 'slider' ); ?>

		<?php endwhile; ?>

	</div>

<?php else :
	?>

	<div id="slider-container" class="container <?php echo $slideshow_type; ?>">
		<div class="slider-inner-container">
			<h2 class="primary-title"><?php _e( 'No Slider no entries were found', 'bon' ); ?></h2>
		</div>
	</div>

<?php
endif;
wp_reset_postdata();
?>