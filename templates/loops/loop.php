<?php if ( have_posts() ) : $data_map = array(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

	<?php

	bon_get_template_part( 'content', ( post_type_supports( get_post_type(), 'post-formats' ) ? get_post_format() : get_post_type() ) );
	?>

	<?php

// remove comments from WooCommerce pages
	if ( is_singular() && !is_front_page() && post_type_supports( get_post_type(), 'comments' ) ) {
		if (shandora_woocommerce_plugin_active()) {
			if ( is_woocommerce() || is_cart() || is_checkout() ) {
			} else {
				comments_template();
			}
		} else {
			comments_template();	
		}

	} // Loads the comments.php template. 
	?>

<?php endwhile; ?>

<?php else : ?>

	<?php bon_get_template_part( 'loop', 'error' ); // Loads the loop-error.php template.   ?>

<?php endif; ?>


<?php

// remove bottom navigation from WooCommerce pages
if (shandora_woocommerce_plugin_active()) {
	if ( is_woocommerce() || is_cart() || is_checkout() ) {
	} else {
	bon_get_template_part( 'loop', 'nav' ); // Loads the loop-nav.php template.	
}
} else {
	bon_get_template_part( 'loop', 'nav' ); // Loads the loop-nav.php template.	
}