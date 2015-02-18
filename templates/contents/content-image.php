<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	$term_meta = wp_get_post_terms( $post->ID, 'category' );
	$ex_class = $term_meta[0]->slug;
	$post_taxonomies = get_terms( 'category', array( 'slug' => $ex_class ) );
	$color = $post_taxonomies[0]->term_id;
	$color = get_option( "taxonomy_$color" );
	$color = $color['color'];
	
	if ( $_SESSION['layoutType'] === 'mobile' ) {
		$size = 'mobile_regular';
	} else {
		$size = 'blog_large';
	}
	
	?>

	<?php if ( is_singular( get_post_type() ) ) { ?>

		<header class="entry-header <?php echo $color; ?>">
			<?php if ( current_theme_supports( 'get-the-image' ) ) get_the_image( array( 'attachment' => false, 'size' => $size, 'before' => '<div class="featured-image">', 'after' => '</div>', 'image_class' => 'auto'  ) ); ?>
			<?php echo apply_atomic_shortcode( 'entry_title', the_title( '<h1 class="entry-title">', '</h1>', false ) ); ?>
			<?php echo apply_atomic_shortcode( 'entry_byline', '<div class="entry-byline">' . __( '[entry-icon class="show-for-large-up"] [entry-author] [entry-published format="M, d Y" text="'.__('Posted on ','bon').'"] [entry-comments-link] [entry-terms taxonomy="category"] [entry-edit-link]', 'bon' ) . '</div>' ); ?>
		</header><!-- .entry-header -->

		<div class="entry-content clear">
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<p class="page-links">' . '<span class="before">' . __( 'Pages:', 'bon' ) . '</span>', 'after' => '</p>' ) ); ?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php echo apply_atomic_shortcode( 'entry_tag', '<div class="entry-tag">'.__('[entry-terms text="'.__('Tagged in:','bon').'"]', 'bon') . '</div>'); ?>
		</footer><!-- .entry-footer -->

	<?php } else { ?>

		<header class="entry-header <?php echo $color; ?>">
			<?php if ( current_theme_supports( 'get-the-image' ) ) get_the_image( array( 'attachment' => false, 'size' => $size, 'before' => '<div class="featured-image">', 'after' => '</div>', 'image_class' => 'auto'  ) ); ?>
			<?php echo apply_atomic_shortcode( 'entry_title', the_title( '<h3 class="entry-title"><a href="'.get_permalink().'" title="'.the_title_attribute( array('before' => 'Permalink to: ', 'echo' => false) ).'">', '</a></h3>', false ) ); ?>
			<?php echo apply_atomic_shortcode( 'entry_byline', '<div class="entry-byline">' . __( '[entry-icon class="show-for-large-up"] [entry-author] [entry-published format="M, d Y" text="'.__('Posted on ','bon').'"] [entry-comments-link] [entry-terms limit="1" exclude_child="true" taxonomy="category"] [entry-edit-link]', 'bon' ) . '</div>' ); ?>
		</header><!-- .entry-header -->

		<div class="entry-summary">
			<?php wp_link_pages( array( 'before' => '<p class="page-links">' . '<span class="before">' . __( 'Pages:', 'bon' ) . '</span>', 'after' => '</p>' ) ); ?>
		</div><!-- .entry-summary -->


	<?php } ?>

</article><!-- .hentry -->