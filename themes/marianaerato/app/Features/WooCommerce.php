<?php

namespace App\Features;

trait WooCommerce
{
    use PayPerPost;
    public function get_order_url(\WC_Order $order, $purchased = true): string
    {
        $items = $order->get_items();
        $product_id = reset($items)->get_product_id();
        $post_url = $this->get_product_permalink_by_lang($product_id);
        return $purchased ? add_query_arg([
            'purchased' => time(),
        ], $post_url) : $post_url;
    }

    public function send_email($to, $subject, $content): bool {
        $mailer = WC()->mailer();
        $wrapped_content = $mailer->wrap_message($subject, $content);
        return $mailer->send($to, $subject, $wrapped_content);
    }
}
