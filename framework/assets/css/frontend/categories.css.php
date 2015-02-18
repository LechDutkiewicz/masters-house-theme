<?php
header( 'Content-Type: text/css; charset=utf-8' );
require '/../../../../../../../wp-load.php';

$property_taxonomies = get_terms( 'property-type' );
// loop for custom colors for product's types
foreach ( $property_taxonomies as $taxonomy ) :
	$term_meta = $taxonomy->term_id;
	$term_meta = get_option( "taxonomy_$term_meta" );
	$color = $term_meta['color'];
	$colorDarker = colourBrightness( $color, -0.1 );
	if ( $color ) :	?>
.listings .<?php echo $taxonomy->slug; ?> .entry-header .property-type, .listings .<?php echo $taxonomy->slug; ?> footer, .list-view .<?php echo $taxonomy->slug; ?> .entry-title .price { background:<?php echo $color; ?>; }
.listings .<?php echo $taxonomy->slug; ?> .entry-header .property-type:hover, .listings .<?php echo $taxonomy->slug; ?> footer:hover { background: <?php echo $colorDarker; ?>; }
.listings .<?php echo $taxonomy->slug; ?> footer { border-bottom-color:<?php echo $colorDarker; ?>; }
.listings .<?php echo $taxonomy->slug; ?> .entry-header { border-bottom-color:<?php echo $color; ?>; }
	<?php endif; endforeach;

$blog_categories = get_categories();
// loop for custom colors for product's types
foreach ( $blog_categories as $category ) :
	$term_meta = $category->term_id;
	$term_meta = get_option( "taxonomy_$term_meta" );
	$color = $term_meta['color'];
	$colorDarker = colourBrightness( $color, -0.1 );
	if ( $color ) :	?>
article.post.category-<?php echo $category->slug; ?> .entry-header .featured-image, article.post.category-<?php echo $category->slug; ?> .entry-header .entry-video { border-bottom-color:<?php echo $color; ?>; }
article.post.category-<?php echo $category->slug; ?> .entry-summary .button.flat { background:<?php echo $color; ?>; border-bottom-color:<?php echo $colorDarker; ?>; }
article.post.category-<?php echo $category->slug; ?> .entry-summary .button.flat:hover, article.post.category-<?php echo $category->slug; ?> .entry-summary .button.flat:focus { background:<?php echo $colorDarker; ?>; }
	<?php endif; endforeach;
