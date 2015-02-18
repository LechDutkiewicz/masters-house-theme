<?php
$view = isset( $_GET['view'] ) ? $_GET['view'] : 'grid';

// added by Lech Dutkiewicz to fetch property's category

if ( ($wp_query->current_post + 1) == ($wp_query->post_count) ) {
	$li_class .= ' last';
}
?>
<li <?php post_class(); ?>>

	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

	<a href="<?php the_permalink(); ?>">

		<?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>

		<h3><?php the_title(); ?></h3>

		<?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>

	</a>

	<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>

</li>