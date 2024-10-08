<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author           WooThemes
 * @package          WooCommerce/Templates
 * @version          1.6.4
 * @flatsome-version 3.16.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header();

do_action( 'flatsome_before_product_page' );

?>

	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		// do_action( 'woocommerce_before_main_content' );
	?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php
			if ( flatsome_product_block( get_the_ID() ) ) {
				wc_get_template_part( 'content', 'single-product-custom' );
			} else {
				wc_get_template_part( 'content', 'single-product' );
			}
			?>

		<?php endwhile;  ?>

	<?php
		// do_action( 'woocommerce_after_main_content' );
	?>

<?php

// do_action( 'flatsome_after_product_page' );

get_footer();

?>
