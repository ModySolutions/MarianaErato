<?php

define('THEME_URI', trailingslashit(get_stylesheet_directory_uri()));

add_action('wp_enqueue_scripts', function(){
    wp_enqueue_script('marianaerato', THEME_URI . 'assets/marianaerato.js', ['jquery'], time(), true);
});

add_filter('body_class', function( $classes ){
   if(is_page()) {
       $page = get_post(get_the_ID());
       $slug = $page->post_name;
       return array_merge($classes, [$slug]);
   }
   return $classes;
});

add_filter('woocommerce_add_to_cart_validation', function ($passed) {
    wc_empty_cart();
    return $passed;
}, 9999);

add_filter('woocommerce_checkout_fields', function ( $fields ) {
    global $woocommerce;
    if(!$woocommerce) return $fields;
    if(!$woocommerce->cart) return $fields;
    $only_virtual = !$woocommerce->cart->needs_shipping();
    if($only_virtual) {
        unset($fields['billing']['billing_company']);
        unset($fields['billing']['billing_address_1']);
        unset($fields['billing']['billing_address_2']);
        unset($fields['billing']['billing_city']);
        unset($fields['billing']['billing_postcode']);
        unset($fields['billing']['billing_country']);
        unset($fields['billing']['billing_state']);
        unset($fields['billing']['billing_phone']);
    }
    return $fields;
});

$glob = glob(__DIR__ . DIRECTORY_SEPARATOR . 'acf' . DIRECTORY_SEPARATOR . '*.php');
if(count($glob) > 0) {
    foreach($glob as $file) {
        if(file_exists($file)) {
            require_once $file;
        }
    }
}

add_action('woocommerce_checkout_create_order', function($order, $data) {
    $items = $order->get_items();

    foreach ($items as $item_id => $item) {
        $product_id = $item->get_product_id();
        $product_url = get_permalink($product_id);
        $order->update_meta_data('product_url', $product_url);
    }
}, 10, 2);

add_filter('http_request_host', function($url, $type = '', $args = null, $url_type = '') {
    $blocked_domains = array(
        'api.wordpress.org',
        'downloads.wordpress.org',
        'wordpress.org',
    );

    foreach ($blocked_domains as $blocked_domain) {
        if (str_contains($url, $blocked_domain)) {
            return new WP_Error('blocked_connection', __('Connection blocked to wordpress.org', 'your-text-domain'));
        }
    }

    return $url;
});

add_filter('pre_http_request', function($a) {
    return false;
});

require_once dirname(__FILE__) . '/vendor/autoload.php';
require_once dirname(__FILE__) . '/config/application.php';