<?php

function shandora_custom_background_setup() {
	$args = array(
		'default-color'          => '#ffffff',
		'default-image'          => BON_THEME_URI . '/assets/images/patterns/darkwood.jpg',

		'wp-head-callback'       => 'shandora_background_style',
		'admin-head-callback'    => '',
		'admin-preview-callback' => '',
	);

	add_theme_support( 'custom-background', $args );


}
add_action( 'after_setup_theme', 'shandora_custom_background_setup' );

function shandora_background_style() {

	$background_image = set_url_scheme(get_background_image());

	$color = get_theme_mod( 'background_color' );

	$style = $color ? "background-color: #$color;" : '';
	
	$image = $background_image ? " background-image: url('$background_image');" : '';

    $repeat = get_theme_mod( 'background_repeat', 'no-repeat' );
    if ( ! in_array( $repeat, array( 'no-repeat', 'repeat-x', 'repeat-y', 'repeat' ) ) )
        $repeat = 'repeat';
    $repeat = " background-repeat: $repeat;";

    $position = get_theme_mod( 'background_position_x', 'left' );
    if ( ! in_array( $position, array( 'center', 'right', 'left' ) ) )
        $position = 'left';
    $position = " background-position: top $position;";

    $attachment = get_theme_mod( 'background_attachment', 'scroll' );
    if ( ! in_array( $attachment, array( 'fixed', 'scroll' ) ) )
        $attachment = 'scroll';
    $attachment = " background-attachment: $attachment;";

    $style .= $image . $repeat . $position . $attachment;

	// If we get this far, we have custom styles.
	?>
	<style type="text/css" id="shandora-background-css">
		body.custom-background {
			<?php echo trim( $style ); ?>
		}
	</style>
	<?php
}