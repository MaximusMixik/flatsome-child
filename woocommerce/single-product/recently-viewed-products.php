<?php
if ( ! isset( $_COOKIE['user_viewed_products'] ) ) {
    echo '<p>You haven\'t viewed any products yet.</p>';
    return;
}

$viewed_products = explode( ',', $_COOKIE['user_viewed_products'] );

if ( empty( $viewed_products ) ) {
    echo '<p>You haven\'t viewed any products yet.</p>';
    return;
}

$args = array(
    'post_type' => 'product',
    'post__in'  => $viewed_products,
    'orderby'   => 'post__in',
);

$query = new WP_Query( $args );

if ( $query->have_posts() ) :
    echo 'Recently 
viewed products';
    echo '<ul class="user-viewed-products">';
    while ( $query->have_posts() ) : 
        $query->the_post();

        // We need make it slider 
        ?>

        <li style="max-width: 200px;"> 
        <?php wc_get_template_part( 'content', 'product' ); // Use the default WooCommerce product template ?>

        </li> 

        <?php 

    endwhile; 
    echo '</ul>';
endif; 
wp_reset_postdata();
