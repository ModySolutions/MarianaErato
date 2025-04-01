<?php

namespace App\Hooks\Admin;

class Settings
{
    public function init(): void
    {
        add_action('acf/init', [$this, 'acf_init']);
        add_action('acf/include_fields', [$this, 'acf_include_fields']);
    }

    public function acf_init(): void
    {
        if (!function_exists('acf_add_options_page')) {
            return;
        }
        acf_add_options_page([
            'page_title' => __('Mariana Erato', APP_THEME_DOMAIN),
            'menu_slug' => 'mariana-erato',
            'parent_slug' => 'options-general.php',
            'position' => '',
            'redirect' => false,
        ]);
    }

    public function acf_include_fields(): void
    {
        if (!function_exists('acf_add_local_field_group')) {
            return;
        }

        acf_add_local_field_group([
            'key' => 'group_67910896cb2dc',
            'title' => __('Settings', APP_THEME_DOMAIN),
            'fields' => [
                [
                    'key' => 'field_67aa48f441f4a',
                    'label' => __('Store', APP_THEME_DOMAIN),
                    'name' => '',
                    'aria-label' => '',
                    'type' => 'tab',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => [
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ],
                    'wpml_cf_preferences' => 1,
                    'placement' => 'top',
                    'endpoint' => 0,
                    'selected' => 0,
                ],
                [
                    'key' => 'field_67910897f53f7',
                    'label' => __('Buy post text', APP_THEME_DOMAIN),
                    'name' => 'buy_this_post_text',
                    'aria-label' => '',
                    'type' => 'textarea',
                    'instructions' => __('Wildcard %s will be replaced by product price.', APP_THEME_DOMAIN),
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => [
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ],
                    'wpml_cf_preferences' => 2,
                    'default_value' => __('Compra este post por %s', APP_THEME_DOMAIN),
                    'maxlength' => 100,
                    'allow_in_bindings' => 0,
                    'rows' => 3,
                    'placeholder' => __('Compra este post por %s', APP_THEME_DOMAIN),
                    'new_lines' => '',
                ],
                [
                    'key' => 'field_67aa490641f4b',
                    'label' => __('Blog', APP_THEME_DOMAIN),
                    'name' => '',
                    'aria-label' => '',
                    'type' => 'tab',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => [
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ],
                    'wpml_cf_preferences' => 1,
                    'placement' => 'top',
                    'endpoint' => 0,
                    'selected' => 0,
                ],
                [
                    'key' => 'field_67aa491241f4c',
                    'label' => __('Appeals text', APP_THEME_DOMAIN),
                    'name' => 'appeals_text',
                    'aria-label' => '',
                    'type' => 'wysiwyg',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => [
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ],
                    'wpml_cf_preferences' => 2,
                    'default_value' => '',
                    'allow_in_bindings' => 0,
                    'tabs' => 'all',
                    'toolbar' => 'full',
                    'media_upload' => 1,
                    'delay' => 0,
                ],
                [
                    'key' => 'field_67aa493141f4d',
                    'label' => __('Complaints text', APP_THEME_DOMAIN),
                    'name' => 'complaints_text',
                    'aria-label' => '',
                    'type' => 'wysiwyg',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => [
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ],
                    'wpml_cf_preferences' => 2,
                    'default_value' => '',
                    'allow_in_bindings' => 0,
                    'tabs' => 'all',
                    'toolbar' => 'full',
                    'media_upload' => 1,
                    'delay' => 0,
                ],
            ],
            'location' => [
                [
                    [
                        'param' => 'options_page',
                        'operator' => '==',
                        'value' => 'mariana-erato',
                    ],
                ],
            ],
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => '',
            'active' => true,
            'description' => '',
            'show_in_rest' => 0,
            'acfml_field_group_mode' => 'translation',
        ]);
    }
}
