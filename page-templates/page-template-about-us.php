<?php
/*
 * Template Name: About us
 */
get_header();
?>
<div id="inner-wrap" class="<?php echo shandora_is_home() ? 'home ' : ''; ?>slide">

    <div id="body-container" class="container">

		<?php
		/**
		 * Shandora Before Loop Hook
		 *
		 * @hooked shandora_get_page_header - 1
		 * @hooked shandora_open_main_content_row - 5
		 * @hooked shandora_open_main_content_column - 15
		 * @hooked shandora_get_right_sidebar - 10
		 *
		 */
		$headFirst = bon_get_option( 'about_us_heading_first' );
		$contentFirst = bon_get_option( 'about_us_content_first' );
		$headSecond = bon_get_option( 'about_us_heading_second' );
		$imgSecond = pippin_get_image_id( bon_get_option( 'about_us_img_second', 'yes' ) );
		$contentSecond = bon_get_option( 'about_us_content_second' );
		$headAdvantages = bon_get_option( 'about_us_heading_advantages' );
		$advantages = bon_get_option( 'about_us_advantages' );
		$headTeam = bon_get_option( 'about_us_heading_team' );
		$contentTeam = bon_get_option( 'about_us_content_team' );
		$headContact = bon_get_option( 'about_us_heading_contact' );
		$contentContact = bon_get_option( 'about_us_content_contact' );
		$agent_id = bon_get_option( 'global_agent' )[0];
		$agent_email = shandora_get_meta( $agent_id, 'agentemail' );
		if ( empty( $agent_email ) ) {
			$agent_email = get_option( 'admin_email' );
		}
		if ( $_SESSION['layoutType'] === 'mobile' ) {
			$size = 'agent_small_mobile';
		} else {
			$size = 'agent_small';
		}

		do_atomic( 'before_loop' );
		?>

		<section class="row entry-content">

			<?php if ( $headFirst && $contentFirst ) : ?>

				<header class="column large-<?php echo ( $headAdvantages && !empty( $advantages ) ) ? '6' : '12'; ?>">
					<h3 ><?php echo $headFirst; ?></h3>
					<hr />
					<span><?php echo $contentFirst; ?></span>
				</header>	

			<?php endif; ?>	

			<?php if ( $headAdvantages && !empty( $advantages ) ) : ?>

				<div class="column large-<?php echo ( $headFirst && $contentFirst ) ? '6' : '12'; ?>">
					<h3 ><?php echo $headAdvantages; ?></h3>
					<hr />
					<div class="adv-result">

						<?php foreach ( $advantages as $advantage ) : ?>

							<div class="adv-option">
								<div class="adv-details">
									<span class="option-label"><?php echo $advantage['advantage_name']; ?></span>
								</div>
								<div class="adv-icon">
									<i class="sha-check-round-2"></i>
								</div>
								<div class="adv-result"></div>
							</div>

						<?php endforeach; ?>

					</div>
				</div>

			<?php endif; ?>	

		</section>

		<section class="row entry-content">

			<?php if ( $headSecond && $contentSecond && $imgSecond ) : ?>

				<header class="column large-12">
					<h3 ><?php echo $headSecond; ?></h3>
					<hr />
				</header>
				<div class="column large-6">
					<?php if ( current_theme_supports( 'get-the-image' ) ) get_the_image( array( 'post_id' => $imgSecond, 'size' => 'listing_medium', 'link_to_post' => false, 'image_class' => 'auto' ) ); ?>
				</div>
				<div class="column large-6">
					<span><?php echo $contentSecond; ?></span>
				</div>

			<?php endif; ?>

		</section>

		<?php bon_get_template_part( 'block', 'testimonials-slider' ); ?>

		<section class="row entry-content">

			<?php if ( $headTeam && $contentTeam ) : ?>

				<div class="listing-contact">
					<header class="column large-12">
						<h3><?php echo $headTeam; ?></h3>
						<hr />
					</header>
					<div class="column large-9 small-8 agent-detail">
						<h3 class="subheader agent-name"><?php echo get_the_title( $agent_id ); ?></h3>
						<h4><?php echo shandora_get_meta( $agent_id, 'agentjob' ); ?></h4>
						<span><?php echo $contentTeam; ?></span>

						<?php if ( shandora_get_meta( $agent_id, 'agentmobilephone' ) ) { ?> 

							<div class="agent-info">
								<strong><?php _e( 'Mobile:', 'bon' ); ?></strong>
								<span><?php echo shandora_get_meta( $agent_id, 'agentmobilephone' ); ?></span>
							</div>

						<?php } ?>

						<?php if ( shandora_get_meta( $agent_id, 'agentofficephone' ) ) { ?>

							<div class="agent-info">	
								<strong><?php _e( 'Offce:', 'bon' ); ?></strong>
								<span><?php echo shandora_get_meta( $agent_id, 'agentofficephone' ); ?></span>
							</div>

						<?php } ?>

						<?php if ( shandora_get_meta( $agent_id, 'agentfax' ) ) { ?>

							<div class="agent-info">			
								<strong><?php _e( 'Fax:', 'bon' ); ?></strong>
								<span><?php echo shandora_get_meta( $agent_id, 'agentfax' ); ?></span>
							</div>

						<?php } ?>	

					</div>
					<div class="column large-3 small-4 agent-detail">				
						<figure>
							<?php
							$img_id = shandora_get_meta( $agent_id, 'agentpic' );
							if ( current_theme_supports( 'get-the-image' ) )
								get_the_image( array( 'post_id' => $img_id, 'size' => $size, 'link_to_post' => false, 'image_class' => 'auto' ) );
							?>
						</figure>
					</div>
				</div>

			<?php endif; ?>

		</section>

		<section class="row entry-content">

			<?php if ( $headContact ) : ?>

				<header class="column large-12">
					<h3><?php echo $headContact; ?></h3>
					<hr />
				</header>
				<div class="column large-12">
					<p><?php echo $contentContact; ?></p>
				</div>
				<div id="detail-tab" class="column large-12">
					<section>
						<nav class="tab-nav">
							<a class="active" href="#tab-target-contact"><?php _e( 'Contact', 'bon' ); ?></a>
							<a href="#tab-target-faq"><?php _e( 'FAQ', 'bon' ); ?></a>
						</nav>
						<div class="tab-contents">
							<div id="tab-target-contact" class="tab-content active">
								<form action="" method="post" id="agent-contactform">
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
										<input type="hidden" name="subject" value="<?php _e( 'Contact from About us Page', 'bon' ); ?>" />
										<input type="hidden" name="listing_id" value="" />
										<input type="hidden" name="receiver" value="<?php echo $agent_email; ?>" />
										<input class="flat button blue radius" name="submit" type="submit" id="submit" tabindex="5" value="<?php _e( 'Submit', 'bon' ) ?>" />
										<span class="contact-loader"><img src="<?php echo trailingslashit( BON_THEME_URI ); ?>assets/images/loader.gif" alt="loading..." />
									</div>
									<div class="sending-result"><div class="green bon-toolkit-alert"></div></div>
								</form>
							</div>
						</div>
						<div class="tab-contents">
							<div id="tab-target-faq" class="tab-content">
								<?php bon_get_template_part( 'block', 'listing/faq' ); ?>						
							</div>
						</div>
					</section>
				</div>

			<?php endif; ?>
			
		</section>

		<?php wp_reset_query(); ?>
		<?php
		/**
		 * Shandora After Loop Hook
		 *
		 * @hooked shandora_close_main_content_column - 1
		 * @hooked shandora_get_right_sidebar - 5
		 * @hooked shandora_close_main_content_row - 10
		 *
		 */
		do_atomic( 'after_loop' );
		?>

	</div>


	<?php get_footer(); ?>
