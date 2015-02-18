<?php
$id = 'featured-listing';
if ( $_SESSION['layoutType'] === 'mobile' ) {
	$args = array( 'per_slide' => 1, 'limit' => 5 );
} else {
	$args = array( 'per_slide' => 4, 'limit' => 20 );
}
?>
<?php
$prefix = bon_get_prefix();
$query = array(
	'post_type' => 'product',
	'posts_per_page' => $args['limit'],
	'orderby' => 'rand'
);
$loop = new WP_Query( $query );

if ( $loop->have_posts() ) :
	$i = 1;
	?>
	<section>
		<header class="section-header">
			<h3 class="home-section-header"><?php _e( 'Improve your leisure time', 'bon' ); ?></h3>
		</header>
		<div class="row entry-row">
			<div class="column large-12 featured-listing-carousel">
				<div id="<?php echo $id; ?>-slider" class="woocommerce woocommerce-slider">

					<ul class="slides bxslider-no-thumb-slide">

						<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

							<?php if ( $_SESSION['layoutType'] === 'mobile' || ( ($_SESSION['layoutType'] === 'tablet' || $_SESSION['layoutType'] === 'classic' ) && $i % $args['per_slide'] == 1) ) : ?>

								<li>
									<ul class="products small-block-grid-1 medium-block-grid-2 large-block-grid-4">

									<?php endif; ?>

									<?php bon_get_template_part( 'woocommerce', 'content-product' ); ?>

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
			endif;
			wp_reset_query();
			?>
		</div>
	</div>
</section>

