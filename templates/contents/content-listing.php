<?php

if ( is_singular( get_post_type() ) ) {
	?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="http://schema.org/Product">
		<header class="entry-header clear">
			<?php echo apply_atomic_shortcode( 'entry_title', the_title( '<h1 class="entry-title" itemprop="name">', '</h1>', false ) ); ?>

		</header><!-- .entry-header -->

		<?php do_atomic( 'before_single_entry_content' ); ?>

		<section class="entry-content clear" itemprop="description">
			<div class="row">
				<div class="column large-8">
					<?php the_content(); ?>
					<!-- addons included in price -->
					<?php shandora_listing_addon(); ?>
				</div>
				<div class="column large-4">
					<?php bon_get_template_part( 'block', 'block-price' ); ?>
				</div>
				<?php wp_link_pages( array( 'before' => '<p class="page-links">' . '<span class="before">' . __( 'Pages:', 'bon' ) . '</span>', 'after' => '</p>' ) ); ?>
			</div>
		</section><!-- .entry-content -->

		<?php do_atomic( 'after_single_entry_content' ); ?>

	</article>
	<?php
} else {

	$view = isset( $_GET['view'] ) ? $_GET['view'] : 'grid';

	if ( ($wp_query->current_post + 1) == ($wp_query->post_count) ) {
		$ex_class .= ' last';
	}
	?>
	<li class="<?php echo extra_class($post->ID) . $ex_class; ?>">
		<article id="post-<?php the_ID(); ?>" <?php post_class(get_cat_color($post->ID)); ?> itemscope itemtype="http://schema.org/Product">

			<?php
			if ( $view == 'list' ) {
				echo '<div class="row"><div class="column large-3 small-4">';
			}

			bon_get_template_part( 'block', 'listing-header' );

			if ( $view == 'list' ) {
				echo '</div>';
				echo '<div class="column large-9 small-8">';
			}
			?>

			<div class="entry-summary">

				<?php do_atomic( 'entry_summary' ); ?>

			</div><!-- .entry-summary -->

			<?php
			if ( $view == 'list' ) {

				echo '</div></div>';
			}
			?>

			<?php
			if ( $view == 'grid' ) {
				bon_get_template_part( 'block', 'listing-footer' );
			}
			?>

		</article>
	</li>

<?php } ?>