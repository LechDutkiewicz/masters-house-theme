<?php
if ( is_active_sidebar( 'woocommerce' ) ) :
	?>

	<aside id="sidebar-woocommerce" class="sidebar <?php echo shandora_column_class( 'large-4' ); ?>">

		<?php dynamic_sidebar( 'woocommerce' ); ?>

	</aside><!-- #sidebar-primary .aside -->

	<?php

endif;