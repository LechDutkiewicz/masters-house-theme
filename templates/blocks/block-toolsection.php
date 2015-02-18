<?php
if ( $_SESSION['layoutType'] === 'tablet' || $_SESSION['layoutType'] === 'classic' ) :
	$imgid = pippin_get_image_id( bon_get_option( 'tool_section_img', 'yes' ) );
	if ( !empty( $imgid ) ) :
		?>
		<section>
			<header>
				<h3><?php echo bon_get_option( 'tool_section_title', 'yes' ); ?></h3>
			</header>
			<hr />
			<div class="row entry-content">
				<div class="column large-8">
					<?php echo wp_get_attachment_image( $imgid, 'listing_two_thirds' ); ?>
				</div><div class="column large-4">
					<h5 class="text orange"><?php echo bon_get_option( 'tool_section_heading', 'yes' ); ?></h5>
					<p><?php echo bon_get_option( 'tool_section_content', 'yes' ); ?></p>
					<?php if ( bon_get_option( 'tool_section_cta_link_url' ) ) : ?>
						<a href="<?php echo bon_get_option( 'tool_section_cta_link_url' ); ?>" class="flat button <?php echo bon_get_option( 'tool_section_cta_color' ) ? bon_get_option( 'tool_section_cta_color' ) : 'blue'; ?> radius cta" onclick="window.open('<?php echo bon_get_option( 'tool_section_cta_link_url' ); ?>', 'VPWindow', 'width=1035,height=690,toolbar=0,resizable=1,scrollbars=1,status=0,location=0');
								return false;" ><?php echo bon_get_option( 'tool_section_cta' ); ?></a>
					   <?php endif; ?>
					   <?php if ( bon_get_option( 'tool_section_contact_display' ) == 1 || bon_get_option( 'tool_section_contact_display' ) == 2 ) : ?>
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