<div id="ebook-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ebook-modal-label" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg <?php echo shandora_get_meta( $post->ID, 'cta_color' ); ?>">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="ebook-modal-label"><?php _e( 'Fill out this form to get your free ebook', 'bon' ); ?></h4>
			</div>
			<div class="modal-body">
				<form action="" method="post" id="ebook-downloadform" class="modal-form">
					<div class="row collapse input-container">
						<!--<div class="column large-2 small-1"><span class="attached-label prefix"><i class="sha-user"></i></span></div>-->
						<div class='column large-12 small-11 input-container-inner name'>
							<input class="attached-input required" type="text" placeholder="<?php _e( 'Full Name', 'bon' ); ?>"  name="name" id="name" value="" size="22" tabindex="1" />
							<div class="contact-form-error" ><?php _e( 'Please enter your name.', 'bon' ); ?></div>
						</div>
					</div>
					<div class="row collapse input-container">
						<!--<div class="column large-2 small-1"><span class="attached-label prefix"><i class="sha-mail-2"></i></span></div>-->
						<div class='column large-12 small-11 input-container-inner mail'>
							<input class="attached-input required email" type="email" placeholder="<?php _e( 'Email Address', 'bon' ); ?>"  name="email" id="email" value="" size="22" tabindex="2" />
							<div class="contact-form-error" ><?php _e( 'Please enter your email.', 'bon' ); ?></div>
						</div>
					</div>
					<div>
						<input type="hidden" name="subject" value="<?php echo "[" . __( 'Ebook from Master\'s House', 'bon' ) . "] " . get_the_title(); ?>" />
						<input type="hidden" name="title" value="<?php echo get_the_title(); ?>" />
						<input type="hidden" name="anchor" value="<?php echo shandora_get_meta( $post->ID, 'cta_header' ); ?>" />
						<input type="hidden" name="ebook_url" value="<?php echo esc_url( shandora_get_meta( $post->ID, 'cta_file' ) ); ?>" />
						<input class="flat button <?php echo shandora_get_meta( $post->ID, 'cta_color' ); ?> radius" name="submit" type="submit" id="submit" tabindex="5" value="<?php _e( 'Get your ebook by email', 'bon' ) ?>" />
						<span class="contact-loader"><img src="<?php echo trailingslashit( BON_THEME_URI ); ?>assets/images/loader.gif" alt="loading..." />
					</div>
					<div class="sending-result"><div class="green bon-toolkit-alert"></div></div>
				</form>
			</div>
		</div>
	</div>
</div>