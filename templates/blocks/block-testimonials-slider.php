<?php
$args = array( 'post_type' => 'testimonial', 'posts_per_page' => 10 );
$loop = new WP_Query( $args );
if ( $loop->have_posts() ) :
	?>
	<section>
		<header class="section-header">
			<h3 class="<?php echo shandora_is_home() ? 'home-section-header' : 'services-header'; ?>"><?php _e( 'Our clients rock', 'bon' ); ?></h3>
			<?php if ( !shandora_is_home() ) echo '<hr />'; ?>
		</header>
		<div class="row entry-row">
			<div class="padding-<?php echo shandora_is_home() ? 'large' : 'medium'; ?> clearfix">
				<div class="column large-12 testimonials-slider-container">
					<div id="testimonials-slider">

						<ul class="slides testimonial-slides bxslider-no-thumb">

							<?php while ( $loop->have_posts() ) : $loop->the_post();
								?>
								<li>
									<div class="testimonial-container">
										<div class="row">
											<?php if ( shandora_is_home() ) : ?>
												<div class="column large-2 blank"></div>
											<?php endif; ?>
											<div class="testimonial column large-<?php echo shandora_is_home() ? '8' : '12'; ?> text-center">
												<span><?php echo get_the_content(); ?></span>
											</div>	
											<?php if ( shandora_is_home() ) : ?>
												<div class="column large-2 blank"></div>
											<?php endif; ?>
										</div>
										<div class="row">			
											<?php if ( shandora_is_home() ) : ?>				
												<div class="column large-2 blank"></div>
											<?php endif; ?>
											<div class="testimonial-author column large-<?php echo shandora_is_home() ? '8' : '12'; ?> text-right">
												<span><?php echo get_the_title(); ?><?php if ( current_theme_supports( 'get-the-image' ) ) get_the_image( array( 'size' => 'user_small', 'link_to_post' => false, 'image_class' => array( 'circle', 'auto' ) ) ); ?></span>
												<?php
												$link = shandora_get_meta( $post->ID, 'related_post' );
												if ( !empty( $link ) ) {
													?>
													<div class="testimonial-link">
														<a href="<?php echo get_permalink( $link ); ?>"><?php _e( 'Read full story', 'bon' ); ?></a>
													</div>
												<?php } ?>
											</div>
											<?php if ( shandora_is_home() ) : ?>
												<div class="column large-2 blank"></div>
											<?php endif; ?>
										</div>
									</div>
								</li>
								<?php
							endwhile;
							?>
						</ul>

					</div>
				</div>
			</div>
		</div>
	</section>
	<?php
endif;
wp_reset_query();
