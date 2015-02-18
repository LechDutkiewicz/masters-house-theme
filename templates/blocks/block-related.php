<?php
$current_post = $post->ID;

// edited by Lech Dutkiewicz

/* $locs = wp_get_object_terms( $current_post, 'property-location' );
  $feats = wp_get_object_terms( $current_post, 'property-feature' ); */
$types = wp_get_object_terms( $current_post, 'property-type' );

$price = shandora_get_meta( $current_post, 'listing_price' );
$size = shandora_get_meta( $current_post, 'listing_lotsize' );
$price_min = $price - ( $price * 20 / 100 );
$price_max = $price + ( $price * 20 / 100 );
$size_min = $size - ( $size * 20 / 100 );
$size_max = $size + ( $size * 20 / 100 );

$loc_query = array();
$type_query = array();
$feat_query = array();
$tax_query = array();

/* if( $locs ) {
  foreach($locs as $loc) {
  $loc_query[] = $loc->slug;
  }

  $tax_query[] = array(
  'taxonomy' => 'property-location',
  'field' => 'slug',
  'terms' => $loc_query,
  );
  } */

/* if( $feats ) {
  foreach( $feats as $feat ) {
  $feat_query[] = $feat->slug;
  }
  $tax_query[] = array(
  'taxonomy' => 'property-feature',
  'field' => 'slug',
  'terms' => $feat_query,
  );
  } */

if ( $types ) {
	foreach ( $types as $type ) {
		$type_query[] = $type->slug;
	}
	$tax_query[] = array(
		'taxonomy' => 'property-type',
		'field' => 'slug',
		'terms' => $type_query,
	);
}

if ( $tax_query && count( $tax_query ) > 1 ) {
	$tax_query['relation'] = 'OR';
}

$posts_per_page = 3;
$layout = get_theme_mod( 'theme_layout' );
if ( empty( $layout ) ) {
	$layout = get_post_layout( get_queried_object_id() );
	if ( $layout == '1c' ) {
		$posts_per_page = 4;
	}
}

$args = array(
	'posts_per_page' => $posts_per_page,
	'post_type' => 'listing',
	'post_status' => 'publish',
	'post__not_in' => (array) $current_post,
	'tax_query' => $tax_query,
	'meta_query' => array(
		'relation' => 'OR',
		array(
			'key' => bon_get_prefix() . 'listing_price',
			'compare' => 'BETWEEN',
			'value' => array( $price_min, $price_max ),
			'type' => 'NUMERIC',
		),
		array(
			'key' => bon_get_prefix() . 'listing_lotsize',
			'compare' => 'BETWEEN',
			'value' => array( $size_min, $size_max ),
			'type' => 'NUMERIC',
		)
	)
);

if ( $_SESSION['layoutType'] === 'mobile' ) {
	$size = 'mobile_tall';
} else {
	$size = 'listing_small';
}

$related_query = get_posts( $args );

if ( $related_query ) :
	$compare_page = bon_get_option( 'compare_page' );
	?>
	<section>
		<header>		
			<h3><?php _e( 'You may also like', 'bon' ); ?></h3>
			<hr />
		</header>
		<ul class="listings related <?php shandora_block_grid_column_class(); ?>" data-compareurl="<?php echo get_permalink( $compare_page ); ?>">

			<?php
			foreach ( $related_query as $post ) :

				$status = shandora_get_meta( $post->ID, 'listing_status' );
				$bed = shandora_get_meta( $post->ID, 'listing_bed' );
				$bath = shandora_get_meta( $post->ID, 'listing_bath' );
				$lotsize = shandora_get_meta( $post->ID, 'listing_buildingsize' );
				$sizemeasurement = bon_get_option( 'measurement' );

// added by Lech Dutkiewicz to fetch property's category

				/*$term_meta = wp_get_post_terms( $post->ID, 'property-type' );
				$ex_class = $term_meta[0]->slug;

				$property_taxonomies = get_terms( 'property-type', array( 'slug' => $ex_class ) );
				$color = $property_taxonomies[0]->term_id;
				$color = get_option( "taxonomy_$color" );

				$ex_class = $ex_class . ' ' . $color['color'];*/

// loop for custom colors for product's types	
				?>
				<li class="<?php echo extra_class($post->ID); ?>">
					<article id="post-<?php $post->ID; ?>" <?php post_class(get_cat_color($post->ID)); ?> itemscope itemtype="http://schema.org/RealEstateAgent">
						<header class="entry-header">

							<?php
							$terms = get_the_terms( $post->ID, "property-type" );

							if ( $terms && !is_wp_error( $terms ) ) {
								foreach ( $terms as $term ) {
									echo '<a class="property-type" href="' . get_term_link( $term->slug, "property-type" ) . '">' . $term->name . '</a>';
									break; // to display only one property type
								}
							}
							?>
							<?php if ( current_theme_supports( 'get-the-image' ) ) { ?>
								<a class="header-link" href="<?php the_permalink(); ?>">
									<div class="overlay"></div>
									<?php get_the_image( array( 'size' => $size, 'link_to_post' => false, 'image_class' => 'auto' ) ); ?>
								</a>
								<?php
							}
							$status_opt = shandora_get_search_option( 'status' );
							?>
							<div class="badge <?php echo $status; ?>"><span><?php
									if ( $status != 'none' ) {
										if ( array_key_exists( $status, $status_opt ) ) {
											echo $status_opt[$status];
										}
									}
									?></span></div>


						</header><!-- .entry-header -->

						<div class="entry-summary">

							<?php do_atomic( 'entry_summary' ); ?>

						</div><!-- .entry-summary -->

						<?php bon_get_template_part( 'block', 'listing-footer' ); ?>

					</article>
				</li>
				<?php
			endforeach;
			?>
		</ul>
	</section>
	<?php
endif;
wp_reset_query();
