<?php
if ( ! isset( $_COOKIE['user_viewed_products'] ) ) {
    // echo '<p>You haven\'t viewed any products yet.</p>';
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

if ( $query->have_posts() ) :   ?>
<section class="recently-viewed-products">
    <div class="recently-viewed-products__container container">
        <h2 class="recently-viewed-products__title">
            Recently viewed products
        </h2>
        <div class="recently-viewed-products__body">
            <div class="recently-viewed-products__wrap">
                <div class="recently-viewed-products__slider swiper-viewed-products ">
                    <div class="recently-viewed-products__wrapper swiper-wrapper">
                        <?php while ( $query->have_posts() ) : 
                            $query->the_post(); 
                            ?>
                            <div class="recently-viewed-products__slide swiper-slide">
                                <?php wc_get_template_part( 'content', 'product' );?>
                            </div>
                        <?php  endwhile;  ?>
                    </div>
                </div>
                    <div class="recently-viewed-products__navigation navigation-swiper">
                        <button type="button" aria-label="button prev" class="navigation-swiper__button big-white navigation-swiper__button--prev">
                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="16" fill="none">
                                <path stroke="#333" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.25" d="M8 14 2 8l6-6"/>
                            </svg>
                        </button>
                        <div class="navigation-swiper__pagination"></div>
                        <button aria-label="button next" type="button" class="navigation-swiper__button big-white navigation-swiper__button--next">
                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="16" fill="none">
                            <path stroke="#333" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.25" d="m2 14 6-6-6-6"/>
                            </svg>
                        </button>
                    </div>
            </div>
        </div>
    </div>
</section>

<?php endif;  
wp_reset_postdata();
