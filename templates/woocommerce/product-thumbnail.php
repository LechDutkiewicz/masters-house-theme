<?php global $post, $product; ?>
<header class="entry-header">
	<?php if ( $product->is_on_sale() ) : ?>
		<div class="badge">
		<?php endif; ?>
		<?php woocommerce_show_product_loop_sale_flash(); ?>
		<?php if ( $product->is_on_sale() ) : ?>
		</div>
	<?php endif; ?>
	<div class="overlay"></div>
	<?php
	if ( $_SESSION['layoutType'] === 'mobile' ) {
		echo woocommerce_get_product_thumbnail( $size = 'mobile_tall' );
	} else {
		echo woocommerce_get_product_thumbnail( $size = 'listing_small' );
	}
	?>
</header>

