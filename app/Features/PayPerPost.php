<?php

namespace App\Features;

trait PayPerPost
{
    public function get_posts_linked_to_product($product_id): array
    {
        $args = [
            'post_type'  => 'post',
            'post_status' => 'publish',
            'meta_query' => [
                [
                    'key'     => 'wc_pay_per_post_product_ids',
                    'value'   => '"' . $product_id . '"',
                    'compare' => 'LIKE',
                ],
            ],
            'posts_per_page' => -1,
        ];

        return get_posts($args);
    }
}
