<?php
/**
 * Header product top.
 *
 * @package          Flatsome/WooCommerce/Templates
 * @flatsome-version 3.16.0
 */

?>
<?php echo do_shortcode('[shop_promo_slider_top]');?>
<div class="page-title shop-page-title product-page-title ">
	<div class="page-title-inner flex-row medium-flex-wrap container">
	  <div class="flex-col flex-grow medium-text-center">
	  		<?php do_action('flatsome_product_title') ;?>
	  </div>

	   <div class="flex-col medium-text-center flatsome_product_title_tools_shortcode">
		   	<?php do_action('flatsome_product_title_tools') ;?>
	   </div>
	</div>
</div>
