<?php
if ( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

global $product;
?>

<?php if ( $price_html = $product->get_price_html() ) : ?>
	<div class="product-price"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo $price_html; ?></a></div>
<?php endif; ?>