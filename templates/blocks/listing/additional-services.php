<?php
$args = array(
	'post_type' => 'additional-service',
	'posts_per_page' => 10,
	'orderby' => 'menu_order',
	'order' => 'ASC'
);
$loop = new WP_Query( $args );
while ( $loop->have_posts() ) : $loop->the_post();
	?>
	<li class="accordion-group">
		<input type="radio" name="toggle-section-services" id="toggle-target-<?php echo $loop->current_post + 10; ?>"<?php if ( $loop->current_post == 0 ) echo ' checked'; ?>>
		<label for="toggle-target-<?php echo $loop->current_post + 10; ?>" class="accordion-section-title"><?php the_title(); ?></label>
		<span class="accordion-open"><i class="sha-arrow-down"></i></span>
		<span class="accordion-close"><i class="sha-arrow-right"></i></span>
		<div class="toggle-content"><?php echo get_the_content(); ?></div>
	</li>
	<?php
endwhile;
wp_reset_query();

