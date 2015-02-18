<div id="customize-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="customize-modal-label" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg blue">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="customize-modal-label"><?php _e( 'Contact us', 'bon' ); ?></h4>
			</div>
			<div class="modal-body">
				<form action="" method="post" id="customize-requestform" class="modal-form">
					<div class="row collapse input-container">
						<div class="column large-12 small-11">											
							<?php
							$phone_html = '';
							$phone = explode( ',', esc_attr( bon_get_option( 'hgroup1_content' ) ) );
							$phone_count = count( $phone );
							if ( $phone_count > 1 ) {
								foreach ( $phone as $number ) {
									$phone_html .= '<strong>' . $number . '</strong>';
								}
							} else {
								$phone_html = '<strong><a href="tel:' . esc_attr( bon_get_option( 'hgroup1_content' ) ) . '">' . esc_attr( bon_get_option( 'hgroup1_content' ) ) . '</a></strong>';
							}
							?>
							<p><?php _e( 'Call us directly at:', 'bon' ); ?><span class="phone phone-<?php echo $phone_count; ?>"> <?php echo $phone_html; ?> </span><?php _e( 'or leave us your details data, so our representative can contact you.', 'bon' ); ?></p>
							<p><?php _e( 'We work from Monday to Friday 8 am to 4 pm. During this time we contact you back within one hour', 'bon' ); ?></p>
						</div>
					</div>
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
					<div class="row collapse input-container">
						<!--<div class="column large-2 small-1"><span class="attached-label prefix"><i class="sha-phone-2"></i></span></div>-->
						<div class='column large-12 small-11 input-container-inner phone'>
							<input class="attached-input" type="text" placeholder="<?php _e( 'Phone Number (optional)', 'bon' ); ?>"  name="phone" id="phone" value="" size="22" tabindex="1" />
							<div class="contact-form-error" ><?php _e( 'Please enter your phone number.', 'bon' ); ?></div>
						</div>
					</div>
					<div class="row collapse textarea-container input-container" data-match-height>
						<!--<div class="column large-2 small-1"><span class="attached-label prefix"><i class="sha-pencil"></i></span></div>-->
						<div class='column large-12 small-11 input-container-inner pencil'>
							<textarea name="messages" class="attached-input required" id="messages" cols="58" rows="10" placeholder="<?php _e( 'Message', 'bon' ); ?>"  tabindex="4"></textarea>
							<div class="contact-form-error" ><?php _e( 'Please enter your messages.', 'bon' ); ?></div>
						</div>
					</div>
					<div>
						<input type="hidden" name="subject" value="<?php printf( __( 'Customization form from %s', 'bon' ), get_the_title() ); ?>" />
						<input type="hidden" name="listing_id" value="<?php echo $post->ID; ?>" />
						<input type="hidden" name="receiver" value="<?php echo get_option( 'admin_email' ); ?>" />
						<input type="hidden" name="title" value="<?php echo get_the_title(); ?>" />
						<input class="flat button blue radius" name="submit" type="submit" id="submit" tabindex="5" value="<?php _e( 'Send', 'bon' ); ?>" />
						<span class="contact-loader"><img src="<?php echo trailingslashit( BON_THEME_URI ); ?>assets/images/loader.gif" alt="loading..." />
					</div>
					<div class="sending-result"><div class="green bon-toolkit-alert"></div></div>
				</form>
			</div>
		</div>
	</div>
</div>