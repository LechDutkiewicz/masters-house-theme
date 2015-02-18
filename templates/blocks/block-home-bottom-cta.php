<?php
$visited = shandora_get_meta( $GLOBALS['home-img'], 'slider_returning' );

if ( $visited != 3 ) {
	$slogan = bon_get_option( 'home_slogan', 5 );
	$ctas = bon_get_option( 'home_cta', 5 );
} else {
	$slogan = bon_get_option( 'home_slogan_returning', 5 );
	$ctas = bon_get_option( 'home_cta_returning', 5 );
}
?>
<section>
	<header class="section-header">
		<?php if ( $slogan ) { ?>
			<h3 class="home-section-header"><?php echo $slogan; ?></h3>
		<?php } ?>
	</header>
	<div  class="row entry-row">
		<div class="padding-medium clearfix">
			<div class="column large-12 text-center home-ctas-container">
				<?php shandora_home_cta( $ctas, $visited ); ?>
			</div>
		</div>
	</div>
</section>