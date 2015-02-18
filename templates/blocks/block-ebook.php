<?php
$args = array( 'post_type' => 'ebook', 'posts_per_page' => 1 );
$loop = new WP_Query( $args );
if ( !empty( $loop->posts ) ) :
	?>
	<section>
		<header class="section-header">
			<h3 class="home-section-header"><?php _e( 'Learn from our experts', 'bon' ); ?></h3>
		</header>
		<div class="row entry-row">
			<div class="padding-medium clearfix">
				<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
					<div class="column large-9">
						<div  class="row entry-row">
							<div class="column large-12">
								<h5 class="section-subheader text <?php echo shandora_get_meta( $post->ID, 'cta_color' ); ?>"><?php echo get_the_title(); ?></h5>
								<h5><?php echo get_the_content(); ?></h5>
							</div>
						</div>
						<div class="row">
							<div class="column large-12 large-uncendered small-11 small-centered bon-builder-element-calltoaction">
								<div class="panel callaction <?php echo shandora_get_meta( $post->ID, 'cta_color' ); ?>">
									<div class="panel-content">
										<h2 class="action-title"><?php echo shandora_get_meta( $post->ID, 'cta_header' ); ?></h2>
										<h3 class="action-content subheader"><?php echo shandora_get_meta( $post->ID, 'cta_subheader' ); ?></h3>
									</div>
									<div class="panel-button">
										<a href='#ebook-modal' role='button' data-toggle='modal' title="<?php echo get_the_title(); ?>">
											<i class="bonicons bi-download"></i>
											<span><?php _e( 'Download', 'bon' ); ?></span>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php if ( $_SESSION['layoutType'] !== 'mobile' ) : ?>
						<div class="column large-3 hide-for-small">
							<a href='#ebook-modal' role='button' data-toggle='modal' title="<?php echo get_the_title(); ?>">
								<?php if ( current_theme_supports( 'get-the-image' ) ) get_the_image( array( 'size' => 'blog_small', 'link_to_post' => false, 'image_class' => 'auto' ) ); ?>
							</a>
						</div>
					</div>
				<?php endif; ?>
			</div>
			<?php
			bon_get_template_part( 'block', 'block-modal-ebook' );
		endwhile;
	endif;
	wp_reset_query();
	?>
</section>