<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	$term_meta = wp_get_post_terms( $post->ID, 'category' );
	$ex_class = $term_meta[0]->slug;
	$post_taxonomies = get_terms( 'category', array( 'slug' => $ex_class ) );
	$color = $post_taxonomies[0]->term_id;
	$color = get_option( "taxonomy_$color" );
	$color = $color['color'];
	?>

	<?php if ( is_singular( get_post_type() ) ) { ?>

		<div class="entry-content clear">
			<?php echo apply_atomic_shortcode( 'entry_quiz', '[bt-poll id="'.$post->ID.'"]'); ?>			
			<?php wp_link_pages( array( 'before' => '<p class="page-links">' . '<span class="before">' . __( 'Pages:', 'bon' ) . '</span>', 'after' => '</p>' ) ); ?>
		</div><!-- .entry-content -->


	<?php } else { ?>

		<header class="entry-header <?php echo $color; ?>">
			<?php echo apply_atomic_shortcode( 'entry_title', the_title( '<h3 class="entry-title"><a href="'.get_permalink().'" title="'.the_title_attribute( array('before' => 'Permalink to: ', 'echo' => false) ).'">', '</a></h3>', false ) ); ?>
		</header><!-- .entry-header -->

		<div class="entry-summary">
			<?php the_excerpt(); ?>
			<?php wp_link_pages( array( 'before' => '<p class="page-links">' . '<span class="before">' . __( 'Pages:', 'bon' ) . '</span>', 'after' => '</p>' ) ); ?>
		</div><!-- .entry-summary -->


	<?php } ?>

</article><!-- .hentry -->