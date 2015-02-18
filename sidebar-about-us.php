<?php //added by Lech Dutkiewicz ?>
<?php if ( is_active_sidebar( 'about-us' ) ) : ?>

	<aside id="sidebar-primary" class="sidebar <?php echo shandora_column_class('large-4'); ?>">

		<?php dynamic_sidebar( 'about-us' ); ?>

	</aside><!-- #sidebar-primary .aside -->

<?php endif; ?>