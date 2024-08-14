<?php 

function codelibry_shop_top_banner_slides_function( $atts ) {
	$attributes = shortcode_atts( array(
		'title' => false,
		'limit' => 4,
	), $atts );
	
	ob_start();

	// Додаємо темплейт парт з аругментами ($args параметер був доданий у WordPress v5.5.0)
	get_template_part( 'template-parts/header/partials/element-shop-promo-slider-top', null, $attributes );

	return ob_get_clean();

}
add_shortcode( 'shop_promo_slider_top', 'codelibry_shop_top_banner_slides_function' );