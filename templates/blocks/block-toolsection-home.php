<?php
if ( $_SESSION['layoutType'] === 'tablet' || $_SESSION['layoutType'] === 'classic' ) :
	$imgid = pippin_get_image_id( bon_get_option( 'tool_section_img', 'yes' ) );
	if ( !empty( $imgid ) ) :
		?>
		<section>
			<header class="section-header">
				<h3 class="home-section-header"><?php echo bon_get_option( 'tool_section_home_title', 'yes' ); ?></h3>
			</header>
			<div class="row entry-row">
				<div class="column large-8">
					<?php echo wp_get_attachment_image( $imgid, 'listing_large', $attr ); ?>
				</div>
				<div class="column large-4">
					<h5 class="section-subheader text orange"><?php echo bon_get_option( 'tool_section_home_heading', 'yes' ); ?></h5>
					<p><?php echo bon_get_option( 'tool_section_home_content', 'yes' ); ?></p>
					<?php if ( bon_get_option( 'tool_section_cta_link_url' ) ) : ?>
						<a href="<?php echo bon_get_option( 'tool_section_cta_link_url' ); ?>" class="flat button large <?php echo bon_get_option( 'tool_section_cta_color' ) ? bon_get_option( 'tool_section_cta_color' ) : 'blue'; ?> radius cta" onclick="window.open('<?php echo bon_get_option( 'tool_section_cta_link_url' ); ?>', 'VPWindow', 'width=1035,height=690,toolbar=0,resizable=1,scrollbars=1,status=0,location=0');
								return false;" ><?php echo bon_get_option( 'tool_section_home_cta' ); ?></a>
					   <?php endif; ?>
					   <?php if ( bon_get_option( 'tool_section_contact_display' ) == 2 || bon_get_option( 'tool_section_contact_display' ) == 3 ) : ?>
						<a href="#customize-modal" role="button" data-toggle="modal" class="flat button blue radius cta" title="Contact us"><?php _e( 'Contact us', 'bon' ); ?></a>
						<?php
						bon_get_template_part( 'block', 'block-modal-customize' );
					endif;
					?>
				</div>
			</div>
		</section>
		<?php
	endif;
endif;