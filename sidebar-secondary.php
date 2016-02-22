<?php if ( is_active_sidebar( 'secondary' ) ) : ?>

	<aside id="sidebar-secondary" class="sidebar <?php echo shandora_column_class('large-4'); ?>">
		<?php if ( is_single() ) { ?>
		<div class="aside-wrapper sticky-wrapper">
			<?php } ?>
			<?php dynamic_sidebar( 'secondary' ); ?>
			<?php if ( is_single() ) { ?>
		</div>
		<?php } ?>
	</aside><!-- #sidebar-primary .aside -->

<?php endif; ?>