<?php
$args = array(
	'post_type' => 'addon',
	'posts_per_page' => 10,
	'orderby' => 'menu_order',
	'order' => 'ASC'
);
$loop = new WP_Query( $args );
$posts = $loop->post_count;
$posts_per_column = ceil( $posts / 4 );
if ( !empty( $loop->posts ) ) :
	?>
	<div class="column large-12">
		<h5 class="text orange"><?php _e( 'Price includes', 'bon' ); ?></h5>
	</div>
	<div class="column small-12 large-3">
		<ul>
			<?php
			while ( $loop->have_posts() ) : $loop->the_post();
				?>
				<li>
					<?php the_title(); ?>
				</li>
				<?php if ( !( $loop->current_post + 1 >= $posts ) && (( $loop->current_post + 1) % $posts_per_column === 0 ) ) : ?>
				</ul>
			</div>
			<div class="column small-12 large-3">
				<ul>
				<?php endif; ?>
				<?php
			endwhile;
			wp_reset_query();
			?>
		</ul>
	</div>
<?php endif; ?>

