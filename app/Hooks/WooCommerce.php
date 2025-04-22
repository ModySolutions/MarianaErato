<?php

namespace App\Hooks;

use App\Features\PayPerPost;
use Automattic\WooCommerce\Enums\OrderStatus;

class WooCommerce
{
    use PayPerPost;
    public function init(): void
    {
        add_action('template_redirect', [$this, 'template_redirect']);
        add_action('woocommerce_checkout_order_created', [$this, 'woocommerce_checkout_order_created'], 10, 2);
        add_action('wc_cc_bill_order_redirect', [$this, 'wc_cc_bill_order_redirect'], 10, 3);
        add_action('woocommerce_thankyou_wc_gateway_ccbill', [$this, 'woocommerce_thankyou_wc']);

        add_filter('woocommerce_add_to_cart_validation', [$this, 'woocommerce_add_to_cart_validation'], 9999);
        add_filter('woocommerce_checkout_fields', [$this, 'woocommerce_checkout_fields']);
        add_filter('wc_cc_bill_set_order_status', [$this, 'wc_cc_bill_set_order_status'], 10, 3);
        add_filter('woocommerce_get_checkout_order_received_url', [$this, 'woocommerce_get_checkout_order_received_url'], 10, 2);
        add_filter('woocommerce_add_to_cart_redirect', [$this, 'woocommerce_add_to_cart_redirect']);
        add_filter('woocommerce_get_checkout_url', [$this, 'woocommerce_get_checkout_url']);
    }

    public function template_redirect(): void
    {
        if (is_cart() && WC()->cart->get_cart_contents_count() > 0) {
            wp_safe_redirect(wc_get_checkout_url());
            exit;
        }
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

    public function woocommerce_checkout_order_created($order): void
    {
        $items = $order->get_items();
        $product_id = reset($items)->get_product_id();
        $product_url = get_permalink($product_id);
        $order->update_meta_data('product_url', $product_url);
        $order->save();
    }

    public function wc_cc_bill_order_redirect(\WC_Order $order): void
    {
        if ($order->is_paid()) {
            $items = $order->get_items();
            $product_id = reset($items)->get_product_id();

            $linked_products = $this->get_posts_linked_to_product($product_id);
            $linked_post_id = reset($linked_products)->ID;

            $lang = apply_filters('wpml_current_language', null);

            $translated_post_id = apply_filters('wpml_object_id', $linked_post_id, 'post', true, $lang);
            $post_url = get_permalink($translated_post_id ?? $linked_post_id);
            do_action('litespeed_purge_url', $post_url);
            $redirect_url = add_query_arg([
                'purchased' => time(),
            ], $post_url);
            wp_safe_redirect($redirect_url);
            exit;
        } else {
            wp_safe_redirect($order->get_view_order_url());
            exit;
        }
    }

    public function woocommerce_thankyou_wc(int $order_id): void
    {
        if (!$order_id) {
            return;
        }
        $order = wc_get_order($order_id);
        if (!$order) {
            return;
        }
        $cache_hash = $_GET['ch'] ?? false;
        if ($cache_hash && $order->is_paid()) {
            do_action('wc_cc_bill_order_redirect', $order);
        }
    }

    public function wc_cc_bill_set_order_status(
        bool $status,
        \WC_Order $order,
        ?string $transaction_id = '',
    ): bool {
        if ($status) {
            $order->add_order_note(__('PDT payment completed', 'woocommerce-payment-gateway-ccbill'));
            $order->payment_complete($transaction_id);
            $order->set_status(OrderStatus::COMPLETED);
            $order->save();
        }
        return $status;
    }

    public function woocommerce_get_checkout_order_received_url(string $order_received_url, \WC_Order $order): string
    {
        if ($order->get_status() === OrderStatus::COMPLETED) {
            wp_update_post([
                'ID' => $order->get_id(),
                'post_status' => OrderStatus::COMPLETED,
            ]);
        }
        $order_received_url = apply_filters('wpml_permalink', $order_received_url, apply_filters('wpml_current_language', null));
        return add_query_arg('ch', time(), $order_received_url);
    }

    public function woocommerce_add_to_cart_redirect(string $url): string
    {
        return wc_get_checkout_url();
    }

    public function woocommerce_get_checkout_url(string $url): string
    {
        return apply_filters('wpml_permalink', $url, apply_filters('wpml_current_language', null));
    }
}
