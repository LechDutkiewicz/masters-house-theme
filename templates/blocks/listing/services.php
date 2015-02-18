<?php if ( $_SESSION['layoutType'] === 'mobile' ) $exClass = 'text-center'; ?>
<?php if ( is_singular( 'listing' ) ) : ?>
	<header>
		<h3 class="services-header"><?php _e( 'Services', 'bon' ); ?></h3>
		<hr />
	</header>
<?php else: ?>
<?php endif; ?>
<?php
$args = array(
	'post_type' => 'service',
	'posts_per_page' => 10,
	'orderby' => 'menu_order',
	'order' => 'ASC'
);
$loop = new WP_Query( $args );
if ( !empty( $loop->posts ) ) :
	?>
	<div class="row">
		<?php while ( $loop->have_posts() ) : $loop->the_post();
			?>
			<div class="column large-12 service-container <?php echo $exClass; ?>">
				<i class="text bonicons <?php echo shandora_get_meta( $post->ID, 'serviceicon' ) . ' ' . shandora_get_meta( $post->ID, 'serviceiconcolor' ); ?>"></i>
				<h5 class="service-title"><?php the_title(); ?></h5>
				<p class="entry-content"><?php echo get_the_content(); ?></p>
			</div>
		<?php endwhile;
		?>
	</div>
	<?php
endif;
wp_reset_query();

