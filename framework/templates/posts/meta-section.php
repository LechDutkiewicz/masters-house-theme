<!-- This is the side post box -->
<div id="bon-fee-postbox-container-1" class="bon-fee-postbox-container">

	<div id="metabox-side">
		<?php
			
			$i = 0;

			global $wp_meta_sections;

			if( $wp_meta_sections ) {
				foreach ( $wp_meta_sections as $context => $priorities ) {

					if ( is_array( $priorities ) && $context == 'side' ) {

						ksort( $priorities );

						foreach ( $priorities as $priority => $sections ) {

							if ( is_array( $sections ) ) {

								foreach ( $sections as $section ) {

									$i++;

									?>
									<div id="bon-fee-meta-box-<?php echo $section['id']; ?>" class="bon-fee-postbox">
										<div id="<?php echo $section['id']; ?>" class="postbox <?php echo postbox_classes( $section['id'], $post_type ); ?>">
											<div title="<?php _e( 'Click to toggle' ); ?>" class="handlediv"><br></div>
											<h3 class="hndle"><span><?php echo $section['title']; ?></span></h3>
											<div class="inside">
												<?php call_user_func( $section['callback'], $post, $section ); ?>
											</div>
										</div>
									</div>
									<?php
								}
							}
						}
					}
				}
			}
		?>
	</div>

</div><!-- end bon-fee-postbox-container-1 -->

<div id="bon-fee-postbox-container-2" class="bon-fee-postbox-container">

	<div id="metabox-advanced">

	<?php
		
		do_action( 'bon_fee_meta_section', 'advanced' );

		$i = 0;

		if( $wp_meta_sections ) {
			
			foreach ( $wp_meta_sections as $context => $priorities ) {

				if ( is_array( $priorities ) && $context == 'advanced' ) {

					ksort( $priorities );

					foreach ( $priorities as $priority => $sections ) {

						if ( is_array( $sections ) ) {

							foreach ( $sections as $section ) {

								$i++;

								?>
								<div id="bon-fee-meta-box-<?php echo $section['id']; ?>" class="bon-fee-postbox">
									<div id="<?php echo $section['id']; ?>" class="postbox">
										<div title="<?php _e( 'Click to toggle' ); ?>" class="handlediv"><br></div>
										<h3 class="hndle"><span><?php echo $section['title']; ?></span></h3>
										<div class="inside">
											<?php call_user_func( $section['callback'], $post, $section ); ?>
										</div>
									</div>
								</div>
								<?php
							}
						}
					}
				}
			}
		}
	?>
	</div>

</div><!-- end bon-fee-postbox-container-2 -->