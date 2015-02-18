<?php
$id = 'featured-listing';
if ( $_SESSION['layoutType'] === 'mobile' ) {
	$args = array( 'per_slide' => 1, 'limit' => 5 );
} else {
	$args = array( 'per_slide' => 4, 'limit' => 20 );
}
$ctaArgs = array(
	'button_icon' => bon_get_option( 'listing_cta_icon', 'yes' ),
	'title' => bon_get_option( 'listing_cta_title', 'yes' ),
	'subtitle' => bon_get_option( 'listing_cta_subtitle', 'yes' ),
	'button_link' => bon_get_option( 'listing_cta_link', 'yes' ),
	'button_text' => bon_get_option( 'listing_cta_anchor', 'yes' )
);
?>
<section>
	<header class="section-header">
		<h3 class="home-section-header"><?php _e( 'Our ready projects', 'bon' ); ?></h3>
	</header>
	<div class="row entry-row">
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
				),
				'orderby' => 'rand'
			);
			$loop = new WP_Query( $query );

			if ( $loop->have_posts() ) : $i = 1;
				?>
				<div id="<?php echo $id; ?>-slider" class="">

					<ul class="slides bxslider-no-thumb-slide">

						<?php while ( $loop->have_posts() ) : $loop->the_post();
							?>
							<?php if ( $_SESSION['layoutType'] === 'mobile' || ( ($_SESSION['layoutType'] === 'tablet' || $_SESSION['layoutType'] === 'classic' ) && $i % $args['per_slide'] == 1) ) : ?>
								<li>
									<ul class="listings small-block-grid-1 medium-block-grid-2 large-block-grid-4">
									<?php endif; ?>

									<?php bon_get_template_part( 'content', 'listing' ); ?>

									<?php if ( $_SESSION['layoutType'] === 'mobile' || ( ($_SESSION['layoutType'] === 'tablet' || $_SESSION['layoutType'] === 'classic' ) && ( $i % $args['per_slide'] == 0 || $loop->posts_count === $loop->current_post ) ) ) : ?>
									</ul>
								</li>
							<?php endif; ?>
							<?php
							$i++;
						endwhile;
						?>
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
</section>

