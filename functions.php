<?php

// Custom shortcodes
require get_stylesheet_directory().'/inc/acf.php';
require get_stylesheet_directory().'/inc/theme-shortcodes.php';

function codelibry_name_scripts() {
	wp_enqueue_style( 'codelibry-main-css', get_stylesheet_directory_uri() . '/assets/css/codelibry-main.css', array('flatsome-main') );

	wp_enqueue_script( 'codelibry-main-script', get_stylesheet_directory_uri() . '/assets/js/custom.js', array(), false );
}
add_action( 'wp_enqueue_scripts', 'codelibry_name_scripts' );


// Add custom Theme Functions here
add_filter('wpcf7_skip_spam_check', '__return_true');



// header custom menu
function register_my_menus() {
    register_nav_menus(
        array(
            'all_products_menu' => __('All Products Menu'),
        )
    );
}

function custom_trim_menu_items($items, $args) {
    if ($args->theme_location !== 'all_products_menu')   return $items;
    $pattern = '/\s*\(.*?\)\s*|\s*,.*$/';
    foreach ($items as &$item)  $item->title = trim(preg_replace($pattern, '', $item->title));
    return $items;
}

add_action('init', 'register_my_menus');
add_filter('wp_nav_menu_objects', 'custom_trim_menu_items', 10, 2);

add_action( 'wp_footer', 'single_add_to_cart_event_text_replacement' );
function single_add_to_cart_event_text_replacement() {
    global $product;

    if( ! is_product() ) return; // Only single product pages
    if( $product->is_type('variable') ) return; // Not variable products
    ?>
        <script type="text/javascript">
            (function($){
                $('button.single_add_to_cart_button, .add_to_cart_button').click( function(){
                    $(this).text('<?php _e( "View cart", "woocommerce" ); ?>');
                });
            })(jQuery);
        </script>
    <?php
}

remove_action( 'flatsome_product_box_actions', 'flatsome_lightbox_button', 50 );

function add_cart_flatsome()
{
		if ( get_theme_mod( 'disable_quick_view', 0 ) ) {
		return;
	}

	global $product;
	
	echo '  <a rel="nofollow" href="/?add-to-cart='. $product->get_id().'" data-quantity="1" data-product_id="'. $product->get_id().'" data-product_sku="" class="add_to_cart_button ajax_add_to_cart">' . __( 'Add to cart', 'flatsome' ) . '</a>';
}
add_action( 'flatsome_product_box_actions', 'add_cart_flatsome', 50 );

function chunk_slider_scripts() {

    wp_enqueue_script( 'chunk.slider-js', get_stylesheet_directory_uri() . '/assets/js/chunk.slider.js', array( 'jquery' ),'',true );
}
add_action( 'wp_enqueue_scripts', 'chunk_slider_scripts' );

add_filter( 'woocommerce_registration_redirect', 'custom_redirection_after_registration', 10, 1 );
function custom_redirection_after_registration( $redirection_url ){
    // Change the redirection Url
    $redirection_url = get_permalink( wc_get_page_id( 'myaccount' ) );

    return $redirection_url; 
}




add_filter( 'woocommerce_product_description_tab_title', 'rename_description_product_tab_label' );
function rename_description_product_tab_label() {
    return 'PRODUCT OVERVIEW';
}

add_filter('woocommerce_order_number', function($default_order_number, \WC_Order $order) {
   
   $order_number = $order->get_meta('_order_change');
   $url_invoice = ['download_invoice', 'print_invoice'];
   if(!empty($order_number) && in_array($_GET["type"], $url_invoice)) {
      return $order_number;
   }

   return $default_order_number;
},10,2);



add_filter('wf_pklist_alter_invoice_date','wt_pklist_change_invoice_date_format',10,3);
function wt_pklist_change_invoice_date_format($invoice_date, $template_type, $order){

	$order_id = $order->get_id();
	$meta_input = get_post_meta($order_id, '_invoice_date_meta_key', true);

	return date("m-d-Y",strtotime($meta_input)); 

}								

/////////////////////END Datepicker for Invoice date		
	
add_action( 'add_meta_boxes', 'mv_add_meta_boxes' );
if ( ! function_exists( 'mv_add_meta_boxes' ) )
{
    function mv_add_meta_boxes()
    {
        add_meta_box( 'mv_other_fields', __('№ Order for invoice','woocommerce'), 'mv_add_other_fields_for_packaging', 'shop_order', 'side', 'core' );
		add_meta_box( 'my_other_fields', __('Payments for invoice','woocommerce'), 'mv_add_field_payment', 'shop_order', 'side', 'core' );
		add_meta_box(
		'meta_box_date_invoice', // Unique ID
		 __('Date for invoice','woocommerce'),    // Meta Box title
		'meta_date_invoice_html',    // Callback function
		'shop_order', 'side', 'core' 
		);
    }
}

function meta_date_invoice_html( $post ) {

	$invoice_date = get_post_meta( $post->ID, '_invoice_date_meta_key', true );
	?>

	<label for="invoice_date">Invoice date</label>
	<input name="invoice_date" type="text" id="datepicker" value="<?php echo esc_attr($invoice_date); ?>">

	<script>
	(function($) {

		'use strict';

		$(document).ready(function() {

		'use strict';

		//Basic jQuery UI Datepicker initialization
		$('#datepicker').datepicker();

		});

	})(window.jQuery);
	</script>
    <?php

}

function meta_box_datepicker_save( $post_id ) {
   if ( array_key_exists( 'invoice_date', $_POST ) ) {
      update_post_meta(
         $post_id,
         '_invoice_date_meta_key',
         $_POST['invoice_date']
      );
   }
}
add_action( 'save_post', 'meta_box_datepicker_save' );

function enqueue_admin_scripts() {

	wp_enqueue_script( 'jquery-ui-datepicker-init',
		plugins_url( 'jquery-ui-datepicker-init.js', __FILE__ ),
		array( 'jquery', 'jquery-ui-datepicker' ),
		'1.00' );
}

function enqueue_admin_styles() {

	wp_enqueue_style( 'jquery-ui',
		'https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css',
		array(),
		'1.00' );
}
////////////////////

if ( ! function_exists( 'mv_add_other_fields_for_packaging' ) )
{
    function mv_add_other_fields_for_packaging()
    {
        global $post;

        $meta_field_data = get_post_meta( $post->ID, '_order_change', true ) ? get_post_meta( $post->ID, '_order_change', true ) : $post->ID;

        echo '<input type="hidden" name="meta_field_custom_number_order" value="' . wp_create_nonce() . '">
        <p style="border-bottom:solid 1px #eee;padding-bottom:13px;">
            <input type="text" style="width:250px;" name="my_field_name" placeholder="' . $meta_field_data . '" value="' . $meta_field_data . '"></p>';

    }
}

if ( ! function_exists( 'mv_add_field_payment' ) )
{
    function mv_add_field_payment()
    {
        global $post;

        $meta_data = get_post_meta( $post->ID, '_payment_change', true ) ? get_post_meta( $post->ID, '_payment_change', true ) : $post->ID;

        echo '<input type="hidden" name="meta_field_payment" value="' . wp_create_nonce() . '">
        <p style="border-bottom:solid 1px #eee;padding-bottom:13px;">
			<select name="my_field_payment" style="width:250px;">';
			echo '<option value="">Selected for invoice</option>';
			if($meta_data=="received"){
				echo '<option selected value="received">received</option>';
			} else {
				echo '<option value="received">received</option>';
			} 
			if($meta_data=="not received"){
				echo '<option selected value="not received">not received</option>';
			} else {
				echo '<option value="not received">not received</option>';
			}
		echo '</select>
			</p>';

    }
}

// Save the data of the Meta field
add_action( 'save_post', 'mv_save_wc_order_other_fields', 10, 1 );
if ( ! function_exists( 'mv_save_wc_order_other_fields' ) )
{

    function mv_save_wc_order_other_fields( $post_id ) {

        if ( ! isset( $_POST[ 'meta_field_custom_number_order' ] ) ) {
            return $post_id;
        }
        $nonce = $_REQUEST[ 'meta_field_custom_number_order' ];

        if ( ! wp_verify_nonce( $nonce ) ) {
            return $post_id;
        }
		
		if ( ! isset( $_POST[ 'meta_field_payment' ] ) ) {
            return $post_id;
        }
        $nonce = $_REQUEST[ 'meta_field_payment' ];

        if ( ! wp_verify_nonce( $nonce ) ) {
            return $post_id;
        }

        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return $post_id;
        }

        if ( 'page' == $_POST[ 'post_type' ] ) {

            if ( ! current_user_can( 'edit_page', $post_id ) ) {
                return $post_id;
            }
        } else {

            if ( ! current_user_can( 'edit_post', $post_id ) ) {
                return $post_id;
            }
        }
        update_post_meta( $post_id, '_payment_change', $_POST[ 'my_field_payment' ] );
        update_post_meta( $post_id, '_order_change', $_POST[ 'my_field_name' ] );
    }								
}

add_filter('wf_pklist_order_additional_item_meta', 'wf_pklist_add_order_meta', 10, 3);
function wf_pklist_add_order_meta($order_item_meta_data, $template_type, $order)
{

	$order_id = $order->get_id();
	$meta=get_post_meta($order_id, '_payment_change', true);
	$order_item_meta_data=$meta;
	return 'Payments: <strong>'.$order_item_meta_data.'</strong>';
}

function get_icon_url($country)
{
	return 'https://exactly.com';
}
		
add_filter( 'woocommerce_gateway_icon', 'change_woocommerce_gateway_icon', 10, 2 );
function change_woocommerce_gateway_icon( $icon, $id ){
	if($id === 'exactly')
	{
		$base_country = WC()->countries->get_base_country();

		$icon_html = sprintf('<a href="%1$s" class="about_exactly" onclick="javascript:window.open(\'%1$s\',\'WIOP\',\'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1060, height=700\'); return false;">' . esc_attr__('', 'exactly_payment') . '</a>', esc_url(get_icon_url($base_country)));

		$icon_html .= '<div style="text-align:center;"><img style="max-width:300px;width:100%;max-height:none;float:none;margin:0 auto;" src="/wp-content/uploads/2023/06/check.png" alt="' . esc_attr__('Exactly', 'woocommerce') . '" /></div>';
		
		return $icon_html;
	} else {
		return $icon;
	}
}

add_filter( 'woocommerce_available_payment_gateways', 'woocommerce_available_payment_gateways' );
function woocommerce_available_payment_gateways( $available_gateways ) {
    if (! is_checkout() ) return $available_gateways;  // stop doing anything if we're not on checkout page.
    if (array_key_exists('exactly',$available_gateways)) {
         $available_gateways['exactly']->order_button_text = __( 'Proceed', 'woocommerce' );
    }
    return $available_gateways;
}
add_filter( 'auto_plugin_update_send_email', '__return_false' );




add_filter( 'woocommerce_registration_error_email_exists', function( $html ) {
    $url =  wc_get_page_permalink( 'myaccount' );
    $url = add_query_arg( 'redirect_checkout', 1, $url );
    $html = str_replace( 'An account is already registered with your email address. ', 'An account is already registered with your email address. <a href="'.$url.'">Please log in.</a>', $html );
    return $html;
} );

add_filter( 'wf_pklist_alter_shipping_method', 'wf_pklist_alter_shipping_method_func', 10, 3 );

function wf_pklist_alter_shipping_method_func($shipping, $template_type, $order) {
    $s = str_replace(['$0.00','free','shipping',',',' ','Free','Shipping'], '', $shipping);
    if ($s === '') {
        $shipping = 'Free shipping';
    }
    return $shipping;
}


function my_custom_show_sale_price_at_cart( $old_display, $cart_item, $cart_item_key ) {

    /** @var WC_Product $product */
    $product = $cart_item['data'];

    if ( $product ) {
        return $product->get_price_html();
    }

    return $old_display;

}
add_filter( 'woocommerce_cart_item_price', 'my_custom_show_sale_price_at_cart', 10, 3 );

function filter_woocommerce_cart_subtotal( $subtotal, $compound, $cart ) {
    $subtotal = 0;
    foreach ( WC()->cart->get_cart() as $key => $cart_item ) {
        $subtotal += $cart_item['data']->get_regular_price() * $cart_item['quantity'];
    }
    $subtotal = wc_price ( $subtotal ); 
    return $subtotal;
} add_filter( 'woocommerce_cart_subtotal', 'filter_woocommerce_cart_subtotal', 10, 3 );


add_action( 'woocommerce_cart_totals_before_order_total', 'bbloomer_show_total_discount_cart_checkout', 9999 );
add_action( 'woocommerce_review_order_before_order_total', 'bbloomer_show_total_discount_cart_checkout', 9999 );


function bbloomer_show_total_discount_cart_checkout() {   
   $discount_total = 0;  
   foreach ( WC()->cart->get_cart() as $cart_item_key => $values ) {         
      $product = $values['data'];
      if ( $product->is_on_sale() ) {
         $regular_price = $product->get_regular_price();
         $sale_price = $product->get_sale_price();
         $discount = ( (float)$regular_price - (float)$sale_price ) * (int)$values['quantity'];
         $discount_total += $discount;
      }
   }          
   if ( $discount_total > 0 ) {
      echo '<tr class="discount-total"><th>Discounts</th><td data-title="Discounts">' . wc_price( $discount_total + WC()->cart->get_discount_total() ) .'</td></tr>';
   }
}


// Добавляем информацию о цене до скидки в блок wc-order-totals
// function custom_order_discounted_price_totals( $order_id ) {
//     $order = wc_get_order( $order_id );

//     foreach ( $order->get_items() as $item_id => $item ) {
//         $product = $item->get_product();
//         $regular_price = $product->get_regular_price();

//         echo '<tr class="discounted-price">';
//         echo '<td class="label"><strong>Discount:</strong></td>';
//         echo '<td width="1%"></td>';
//         echo '<td class="total">' . wc_price( $regular_price ) . '</td>';
//         echo '</tr>';
//     }
// }
// add_action( 'woocommerce_admin_order_totals_after_tax', 'custom_order_discounted_price_totals', 10, 1 );



// Добавляем блок с суммой заказа без скидки на странице редактирования заказа
// function display_order_total_no_discount() {
//     global $post, $the_order;

//     $order_id = $post->ID;
//     $order = wc_get_order( $order_id );

//     // Получаем сумму заказа без скидки
//     $order_total_no_discount = 0;
//     foreach ( $order->get_items() as $item ) {
//         $product = $item->get_product();
//         $order_total_no_discount += $item->get_quantity() * $product->get_regular_price();
//     }

//     echo '<style> .wc-order-totals tr:nth-child(1){display:none;} </style>';

//     echo '<tr class="order-total-no-discount">';
//     echo '<td class="label"><strong>Subtotal:</strong></td>';
//     echo '<td width="1%"></td>';
//     echo '<td class="total">' . wc_price( $order_total_no_discount ) . '</td>';
//     echo '</tr>';
// }
// add_action( 'woocommerce_admin_order_totals_after_tax', 'display_order_total_no_discount' );



// function display_order_discount() {
//     global $post, $the_order;

//     $order_id = $post->ID;
//     $order = wc_get_order( $order_id );

//     $order_total_price = $order->get_total();

//     // Получаем сумму заказа без скидки
//     $order_total_no_discount = 0;
//     foreach ( $order->get_items() as $item ) {
//         $product = $item->get_product();
//         $order_total_no_discount += $item->get_quantity() * $product->get_regular_price();
//     }

//     $discount_total_price = $order_total_no_discount - $order_total_price;

//     if($discount_total_price > 0){

//         echo '<tr class="discounted-price">';
//         echo '<td class="label"><strong>Discount:</strong></td>';
//         echo '<td width="1%"></td>';
//         echo '<td class="total">' . wc_price( $discount_total_price ) . '</td>';
//         echo '</tr>';
//     }
// }
// add_action( 'woocommerce_admin_order_totals_after_tax', 'display_order_discount' );





// // Хук для добавления дополнительного поля на странице редактирования заказа
// add_action('woocommerce_admin_order_item_headers', 'add_custom_order_item_header', 10, 1);
// function add_custom_order_item_header($order_id) {
//     echo '<th class="line_subtotal">' . __('Original Price', 'text-domain') . '</th>';
// }

// add_action('woocommerce_admin_order_item_values', 'add_custom_order_item_value', 10, 3);

// function add_custom_order_item_value($product, $item, $item_id) {
//     // Ensure $product is an instance of WC_Product
//     if (!is_a($product, 'WC_Product')) {
//         return;
//     }
//     // Get product ID
//     $product_id = $product->get_id();

//     // Ensure product ID is valid
//     if (!$product_id || !is_numeric($product_id)) {
//         return;
//     }

//     // Get original price
//     $original_price = get_post_meta($product_id, '_regular_price', true);

//     // Check if the original price is set
//     if ($original_price) {
//         echo '<td class="line_subtotal" data-title="' . __('Original Price', 'text-domain') . '">';
//         echo '<span class="original-price">' . wc_price($original_price) . '</span>';
//         echo '</td>';
//     }
// }



//function wf_module_generate_template_html_func($find_replace,$html,$template_type,$order,$box_packing=null,$order_package=null) {
//  $find_replace['wfte_product_table_shipping'] = 'TEST';
//  $find_replace['wfte_shipping_method'] = 'FREE TEST';
//  return $find_replace;
//}
//
//add_filter('wf_module_generate_template_html','wf_module_generate_template_html_func',10,10);


//company_email invoice
add_action('admin_menu','company_email_add_option_to_general'); 
function company_email_add_option_to_general(){ 
	$option_name = 'company_email'; 
	register_setting( 'general', $option_name); 
	add_settings_field(
		$option_name, 
		'Сompany email', 
		'company_email_option_callback', 
		'general', 
		'default', 
		array(
			'label_for' => $option_name, 
			'name' => $option_name
		)
	); 
} 
function company_email_option_callback( $args ){ 
	printf(
		'<input class="regular-text ltr" type="text" id="%s" name="%s" value="%s" />',
		$args[ 'label_for' ],
		$args[ 'name' ],
		esc_attr( get_option( $args[ 'name' ] ) )
	); 
}
add_filter('wf_pklist_alter_find_replace','wf_pklist_add_values_for_custom_placeholders',10,5);
function wf_pklist_add_values_for_custom_placeholders($find_replace,$template_type,$order,$box_packing,$order_package)
{
	if($template_type=='invoice')
	{
		$find_replace['[wfte_company_email]']=get_option('company_email');		
	}
	return $find_replace;
}
//company_email invoice