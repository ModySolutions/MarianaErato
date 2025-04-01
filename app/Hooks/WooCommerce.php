<?php

namespace App\Hooks;

class WooCommerce
{
    public function init(): void
    {
        add_action('woocommerce_checkout_create_order', [$this, 'woocommerce_checkout_create_order'], 10, 2);

        add_filter('woocommerce_add_to_cart_validation', [$this, 'woocommerce_add_to_cart_validation'], 9999);
        add_filter('woocommerce_checkout_fields', [$this, 'woocommerce_checkout_fields']);
    }

    public function woocommerce_add_to_cart_validation(bool $passed): bool
    {
        wc_empty_cart();
        return $passed;
    }

    public function woocommerce_checkout_fields(array $fields): array
    {
        global $woocommerce;
        if (!$woocommerce) {
            return $fields;
        }
        if (!$woocommerce->cart) {
            return $fields;
        }
        $only_virtual = !$woocommerce->cart->needs_shipping();
        if ($only_virtual) {
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
    }

    public function woocommerce_checkout_create_order($order): void
    {
        $items = $order->get_items();

        foreach ($items as $product_id => $item) {
            $product_url = get_permalink($product_id);
            $order->update_meta_data('product_url', $product_url);
        }
    }
}
