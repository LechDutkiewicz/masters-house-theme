<?php
$visited = shandora_get_meta( $post->ID, 'slider_returning' );

$position = shandora_get_meta( $post->ID, 'slider_position' );

$icon = 'sha-arrow-right';

if ( $visited != 3 ) {
	$slogan = bon_get_option( 'home_slogan', 5 );
	$ctas = bon_get_option( 'home_cta', 5 );
} else {
	$slogan = bon_get_option( 'home_slogan_returning', 5 );
	$ctas = bon_get_option( 'home_cta_returning', 5 );
}

if ( current_theme_supports( 'get-the-image' ) ) {
	if ( $_SESSION['layoutType'] === 'mobile' ) {
		$size = 'featured_slider_mobile';
	} else {
		$size = 'featured_slider';
	}
	$src = get_the_image( array( 'size' => $size, 'format' => 'array' ) );
}
?>

<div class="slider-inner-container <?php echo $position; ?>">
	<div class="slider-bg" style="background-image:url('<?php echo esc_url( $src['url'] ); ?>')"></div>
	<div class="mask <?php echo $visited; ?>"></div>

	<div class="flex-caption home-cta-container">
		<?php if ( $slogan ) { ?>
			<h2 class="primary-title"><span><?php echo $slogan; ?></span></h2>
		<?php } ?>

		<?php if ( $ctas ) { ?>
			<div class="home-ctas-container">
				<?php shandora_home_cta( $ctas, $visited ); ?>
			</div>
		<?php } ?>
	</div>
</div>