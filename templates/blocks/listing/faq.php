<?php
$args = array(
	'post_type' => 'faq',
	'posts_per_page' => -1,
	'orderby' => 'menu_order',
	'order' => 'ASC'
	);
$loop = new WP_Query( $args );
if ( $loop->have_posts() ) :
	if ( is_singular( 'listing' ) ) :
		?>
	<section class="entry-content">
		<header>
			<h3><?php _e( 'faq', 'bon' ); ?></h3>
			<hr />
		</header>
	<?php endif; ?>
	<ul class="bon-toolkit-accordion" id="accordion-faq">
		<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
		<?php if ($loop->current_post == 5 && is_singular( 'listing' ) ) : ?>
		<div class="collapse panel-collapse" id="faqCollapse">
			<div class="well">
		<?php endif; ?>
		<li class="accordion-group">
			<input type="radio" name="toggle-section-faq" id="toggle-target-<?php echo $loop->current_post + 20; ?>">
			<label for="toggle-target-<?php echo $loop->current_post + 20; ?>" class="accordion-section-title"><?php the_title(); ?></label>
			<span class="accordion-open"><i class="sha-arrow-down"></i></span>
			<span class="accordion-close"><i class="sha-arrow-right"></i></span>
			<div class="toggle-content"><?php echo get_the_content(); ?></div>
		</li>
		<?php if ( $loop->current_post + 1 == $loop->post_count && $loop->post_count > 5 && is_singular( 'listing' ) ) : ?>
			</div>
		</div>
		<?php endif; ?>
		<?php
		endwhile;
		?>
	</ul>
	<?php if ($loop->post_count > 5 && is_singular( 'listing' ) ) : ?>
	<a class="button flat silver radius" data-toggle="collapse" href="#faqCollapse" aria-expanded="false" aria-controls="faqCollapse">
	  <?php _e('Show more', 'bon'); ?>
	</a>
	<?php endif; ?>
	<?php wp_reset_query();	?>
	<?php if ( is_singular( 'listing' ) ) : ?>
</section>
<?php
endif;
endif;
?>
