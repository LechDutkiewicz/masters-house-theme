<?php
//Changed by Lech Dutkiewicz

/*$dimensions = array(
	shandora_get_meta( $post->ID, 'listing_dimensionswidth' ),
	shandora_get_meta( $post->ID, 'listing_dimensionsheight' )
);*/
$dimensions = get_post_meta( $post->ID, bon_get_prefix() . 'listing_plandimensions' );
$dimensions = shandora_get_dimensions($dimensions);
$height = shandora_get_meta( $post->ID, 'listing_height' );
$wallheight = shandora_get_meta( $post->ID, 'listing_wallheight' );
$wallthickness = shandora_get_meta( $post->ID, 'listing_wallthickness' );
$floorthickness = shandora_get_meta( $post->ID, 'listing_floorthickness' );
$roofthickness = shandora_get_meta( $post->ID, 'listing_roofthickness' );
//$windows = shandora_get_meta( $post->ID, 'listing_windows' );
//$windowssizes = shandora_get_meta( $post->ID, 'listing_windowssizes' );
$windowssizes = get_post_meta( $post->ID, bon_get_prefix() . 'listing_windowssizes' );
$windowssizes = shandora_get_windows( $windowssizes );
//$doors = shandora_get_meta( $post->ID, 'listing_doors' );
//$doorssizes = shandora_get_meta( $post->ID, 'listing_doorssizes' );
$doorssizes = get_post_meta( $post->ID, bon_get_prefix() . 'listing_doorssizes' );
$doorssizes = shandora_get_doors( $doorssizes );

$price = shandora_get_meta( $post->ID, 'listing_price', true );
//$monprice = shandora_get_meta( $post->ID, 'listing_monprice' );
$lotsize = shandora_get_meta( $post->ID, 'listing_lotsize' );
$terracesqmt = shandora_get_meta( $post->ID, 'listing_terracesqmt' );
$rooms = shandora_get_meta( $post->ID, 'listing_rooms' );
$floors = shandora_get_meta( $post->ID, 'listing_floors' );

$currency = bon_get_option( 'currency' );
$sizemeasurement = bon_get_option( 'measurement' );
$heightmeasurement = bon_get_option( 'height_measure' );

$status_opt = shandora_get_search_option( 'status' );

if ( array_key_exists( $status, $status_opt ) ) {
	$status = $status_opt[$status];
}

//Changed by Lech Dutkiewicz

$details = apply_atomic( 'property_details_tab_content', array(
	'price' => __( 'Price:', 'bon' ),
	'monprice' => __( 'Monthly price:', 'bon' ),
	'lotsize' => __( 'Size:', 'bon' ),
	'terracesqmt' => __( 'Terrace size:', 'bon' ),
	'rooms' => __( 'Rooms:', 'bon' ),
	'floors' => __( 'Floors:', 'bon' ),
		) );

$specs = apply_atomic( 'property_specifications_tab_content', array(
	'dimensions' => __( 'Dimensions:', 'bon' ),
	'height' => __( 'Height:', 'bon' ),
	'wallheight' => __( 'Wall height:', 'bon' ),
	'wallthickness' => __( 'Wall thickness:', 'bon' ),
	'floorthickness' => __( 'Floor thickness:', 'bon' ),
	'roofthickness' => __( 'Roof thickness:', 'bon' ),
	'windows' => __( 'Windows:', 'bon' ),
	'windowssizes' => __( 'Windows sizes:', 'bon' ),
	'doors' => __( 'Doors:', 'bon' ),
	'doorssizes' => __( 'Doors sizes:', 'bon' )
		) );
?>
<section>
	<nav class="tab-nav">
		<?php if ( !empty( $details ) && is_array( $details ) ) { ?> 
			<a class="active" href="#tab-target-details"><?php _e( 'Details', 'bon' ); ?></a>
		<?php } ?>

		<a class="<?php
		if ( empty( $details ) || !is_array( $details ) ) {
			echo 'active';
		}
		?>" href="#tab-target-features"><?php _e( 'Additional services', 'bon' ); ?></a>
		   <?php if ( !empty( $specs ) && is_array( $specs ) ) { ?> 
			<a href="#tab-target-spec"><?php _e( 'Specifications', 'bon' ); ?></a>
		<?php } ?>
	</nav>
	<div class="tab-contents">

		<?php if ( !empty( $details ) && is_array( $details ) ) { ?> 
			<div id="tab-target-details" class="tab-content active">

				<ul class="property-details">
					<?php foreach ( $details as $key => $value ) { ?>
						<?php if ( !empty( $$key ) ) { ?> 
							<li>
								<strong><?php echo $value; ?> </strong>
								<span>
									<?php
									echo $$key;
									if ( $key == 'lotsize' || $key == 'terracesqmt' ) {
										echo ' ' . $sizemeasurement;
									}
									if ( $key == 'price' || $key == 'monprice' ) {
										echo ' ' . $currency;
									}
									?>
								</span>
							</li>
						<?php } ?>
					<?php }
					?>
				</ul>

			</div>

		<?php } ?>

		<div id="tab-target-features" class="tab-content">

			<ul class="bon-toolkit-accordion" id="accordion-services">
				<?php
				bon_get_template_part( 'block', trailingslashit( get_post_type() ) . 'additional-services' );
				?>
			</ul>

		</div>

		<?php if ( !empty( $specs ) && is_array( $specs ) ) { ?> 
			<div id="tab-target-spec" class="tab-content">
				<ul class="property-spec">
					<?php foreach ( $specs as $key => $value ) { ?>
						<?php if ( !empty( $$key ) ) { ?> 
							<li>
								<strong><?php echo $value; ?> </strong>
								<span>
									<?php
									echo $$key;
									if ( $key == 'height' || $key == 'wallheight' || $key == 'wallthickness' || $key == 'floorthickness' || $key == 'roofthickness' ) {
										echo ' ' . $heightmeasurement;
									}
									?>
								</span>
							</li>
						<?php } ?>
					<?php }
					?>
				</ul>
			</div>
		<?php } ?>
	</div>
</section>