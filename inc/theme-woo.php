<?php 

/**
 * 
 * Custom WooCommerce functions
 * 
 */

function track_user_viewed_products() {
    if ( ! is_singular('product') ) {
        return;
    }

    global $post;
    $product_id = $post->ID;

    if ( ! isset( $_COOKIE['user_viewed_products'] ) ) {
        $viewed_products = array();
    } else {
        $viewed_products = explode( ',', $_COOKIE['user_viewed_products'] );
    }

    // Remove the product if already viewed to prevent duplicates
    if ( ( $key = array_search( $product_id, $viewed_products ) ) !== false ) {
        unset( $viewed_products[$key] );
    }

    // Add the current product to the beginning of the array
    array_unshift( $viewed_products, $product_id );

    // Limit the number of products stored (e.g., 5)
    $viewed_products = array_slice( $viewed_products, 0, 5 );

    // Set the cookie with a 30-day expiration time
    setcookie( 'user_viewed_products', implode( ',', $viewed_products ), time() + 30 * DAY_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN );

    // Optionally, store in user meta if user is logged in
    if ( is_user_logged_in() ) {
        update_user_meta( get_current_user_id(), '_user_viewed_products', $viewed_products );
    }
}
add_action( 'template_redirect', 'track_user_viewed_products' );


/**
 * Re-order product price and excerpt
 */

// Remove the existing function with priority 10
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );

// Re-add the function with your desired priority, e.g., 15
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 25 );