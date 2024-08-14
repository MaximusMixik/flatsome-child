<?php
/**
 * The template for displaying the footer.
 *
 * @package          Flatsome\Templates
 * @flatsome-version 3.16.0
 */

global $flatsome_opt;


if ( is_shop() || is_product_category() || is_product() ) :
    get_template_part( 'woocommerce/single-product/recently-viewed-products' );
    echo do_shortcode('[block id="global-blog-feed"]');
endif; 




?>


</main>

<footer id="footer" class="footer-wrapper">

	<?php do_action('flatsome_footer'); ?>

</footer>

</div>

<?php wp_footer(); ?>

</body>
</html>
