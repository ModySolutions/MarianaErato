<?php

namespace App\Hooks;

use Woocommerce_Pay_Per_Post_Helper;

class Blog {
    public function init(): void {
        add_action('pre_get_posts', [$this, 'filter_private_galleries']);
    }

    public function filter_private_galleries($query): void {
        if (is_admin() || !$query->is_main_query()) {
            return;
        }

        if (is_home() || is_archive()) {
            $private_tag = get_field('private_gallery_post_tag', 'option');
            $bts_post_tag = get_field('bts_post_tag', 'option');

            if (!$private_tag && $bts_post_tag) {
                return;
            }

            $has_access = current_user_can('administrator');

            if (!$has_access) {
                $tax_query = (array) $query->get('tax_query');
                $tax_query[] = array(
                    'taxonomy' => 'post_tag',
                    'field' => 'id',
                    'terms' => array($private_tag, $bts_post_tag),
                    'operator' => 'NOT IN',
                );

                $query->set('tax_query', $tax_query);
            }
        }
    }
}