<?php

namespace App\Hooks;

class Product {
    public function init (): void {
        add_action('acf/include_fields', [$this, 'register_sponsor_benefits_fields']);
        add_action('acf/load_value/name=elementor_buy_now_button_url', [$this, 'acf_load_buy_now_button_url'], 10, 3);
        add_action('acf/prepare_field/name=elementor_buy_now_button_url', [$this, 'acf_prepare_buy_now_button'], 10);
    }

    public function register_sponsor_benefits_fields(): void {
        if ( ! function_exists( 'acf_add_local_field_group' ) ) {
            return;
        }

        $current_content_tab = array(
            'key' => 'field_695283b20bb3b',
            'label' => __('Current content', APP_THEME_DOMAIN),
            'name' => '',
            'aria-label' => '',
            'type' => 'tab',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'placement' => 'left',
            'endpoint' => 0,
            'selected' => 0,
        );

        $type_of_access_field = array(
            'key' => 'field_695284320bb3c',
            'label' => __('Type of access', APP_THEME_DOMAIN),
            'name' => 'type_of_access',
            'aria-label' => '',
            'type' => 'radio',
            'layout' => 'horizontal',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '50',
                'class' => '',
                'id' => '',
            ),
            'choices' => array(
                'none' => __('None', APP_THEME_DOMAIN),
                'time' => __('Time', APP_THEME_DOMAIN),
                'content' => __('Content', APP_THEME_DOMAIN),
            ),
            'default_value' => false,
            'return_format' => 'value',
            'multiple' => 0,
            'allow_null' => 0,
            'allow_in_bindings' => 0,
            'ui' => 0,
            'ajax' => 0,
            'placeholder' => '',
        );

        $select_content_field = array(
            'key' => 'field_695285e544dd8',
            'label' => __('Select content', APP_THEME_DOMAIN),
            'name' => 'select_content',
            'aria-label' => '',
            'type' => 'checkbox',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => array(
                array(
                    array(
                        'field' => 'field_695284320bb3c',
                        'operator' => '==',
                        'value' => 'content',
                    ),
                ),
                array(
                    array(
                        'field' => 'field_695284320bb3c',
                        'operator' => '==',
                        'value' => 'time',
                    ),
                ),
            ),
            'wrapper' => array(
                'width' => '50',
                'class' => '',
                'id' => '',
            ),
            'choices' => array(
                'video' => __('Video', APP_THEME_DOMAIN),
                'gallery' => __('Gallery', APP_THEME_DOMAIN),
            ),
            'default_value' => array(
                0 => 'video',
            ),
            'return_format' => 'value',
            'allow_custom' => 0,
            'allow_in_bindings' => 0,
            'layout' => 'horizontal',
            'toggle' => 1,
            'save_custom' => 0,
            'custom_choice_button_text' => __('Add new option', APP_THEME_DOMAIN),
        );

        $previous_content_for_field = array(
            'key' => 'field_69528b0a5e41b',
            'label' => __('Previous content for', APP_THEME_DOMAIN),
            'name' => 'previous_content_for',
            'aria-label' => '',
            'type' => 'number',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => array(
                array(
                    array(
                        'field' => 'field_695284320bb3c',
                        'operator' => '==',
                        'value' => 'time',
                    ),
                ),
            ),
            'wrapper' => array(
                'width' => '50',
                'class' => '',
                'id' => '',
            ),
            'default_value' => 1,
            'min' => '',
            'max' => '',
            'allow_in_bindings' => 0,
            'placeholder' => '',
            'step' => 1,
            'prepend' => '',
            'append' => __('month(s)', APP_THEME_DOMAIN),
        );

        $amount_of_videos_field = array(
            'key' => 'field_6952863e44dd9',
            'label' => __('Amount of videos', APP_THEME_DOMAIN),
            'name' => 'amount_of_videos',
            'aria-label' => '',
            'type' => 'number',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => array(
                array(
                    array(
                        'field' => 'field_695285e544dd8',
                        'operator' => '==',
                        'value' => 'video',
                    ),
                    array(
                        'field' => 'field_695284320bb3c',
                        'operator' => '==',
                        'value' => 'content',
                    ),
                ),
            ),
            'wrapper' => array(
                'width' => '50',
                'class' => '',
                'id' => '',
            ),
            'default_value' => 1,
            'min' => '',
            'max' => '',
            'allow_in_bindings' => 0,
            'placeholder' => '',
            'step' => 1,
            'prepend' => '',
            'append' => __('video(s)', APP_THEME_DOMAIN),
        );

        $amount_of_galleries_field = array(
            'key' => 'field_6952867944ddb',
            'label' => __('Amount of galleries', APP_THEME_DOMAIN),
            'name' => 'amount_of_galleries',
            'aria-label' => '',
            'type' => 'number',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => array(
                array(
                    array(
                        'field' => 'field_695285e544dd8',
                        'operator' => '==',
                        'value' => 'gallery',
                    ),
                    array(
                        'field' => 'field_695284320bb3c',
                        'operator' => '==',
                        'value' => 'content',
                    ),
                ),
            ),
            'wrapper' => array(
                'width' => '50',
                'class' => '',
                'id' => '',
            ),
            'default_value' => 1,
            'min' => '',
            'max' => '',
            'allow_in_bindings' => 0,
            'placeholder' => '',
            'step' => 1,
            'prepend' => '',
            'append' => __('gallery/galleries', APP_THEME_DOMAIN),
        );

        $private_gallery_tab = array(
            'key' => 'field_6952882ea66e1',
            'label' => __('Private gallery', APP_THEME_DOMAIN),
            'name' => '',
            'aria-label' => '',
            'type' => 'tab',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'placement' => 'left',
            'endpoint' => 0,
            'selected' => 0,
        );

        $private_gallery_status_field = array(
            'key' => 'field_69528a00bd2b3',
            'label' => __('Status', APP_THEME_DOMAIN),
            'name' => 'private_gallery_status',
            'aria-label' => '',
            'type' => 'radio',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '50',
                'class' => '',
                'id' => '',
            ),
            'choices' => array(
                'inactive' => __('Inactive', APP_THEME_DOMAIN),
                'active' => __('Active', APP_THEME_DOMAIN),
            ),
            'default_value' => '',
            'return_format' => 'value',
            'allow_null' => 0,
            'other_choice' => 0,
            'allow_in_bindings' => 1,
            'layout' => 'horizontal',
            'save_other_choice' => 0,
        );

        $private_gallery_amount_of_gallery_pictures_field = array(
            'key' => 'field_69528b435e41c',
            'label' => __('Amount of pictures', APP_THEME_DOMAIN),
            'name' => 'private_gallery_amount_of_gallery_pictures',
            'aria-label' => '',
            'type' => 'number',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => array(
                array(
                    array(
                        'field' => 'field_69528a00bd2b3',
                        'operator' => '==',
                        'value' => 'active',
                    ),
                ),
            ),
            'wrapper' => array(
                'width' => '50',
                'class' => '',
                'id' => '',
            ),
            'default_value' => 1,
            'min' => '',
            'max' => '',
            'allow_in_bindings' => 0,
            'placeholder' => '',
            'step' => 1,
            'prepend' => '',
            'append' => __('gallery/galleries', APP_THEME_DOMAIN),
        );

        $private_gallery_amount_of_months_back_field = array(
            'key' => 'field_69528b4374ujf',
            'label' => __('Amount of months back', APP_THEME_DOMAIN),
            'name' => 'private_gallery_amount_of_time',
            'aria-label' => '',
            'type' => 'number',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => array(
                array(
                    array(
                        'field' => 'field_69528a00bd2b3',
                        'operator' => '==',
                        'value' => 'time',
                    ),
                ),
            ),
            'wrapper' => array(
                'width' => '50',
                'class' => '',
                'id' => '',
            ),
            'default_value' => 1,
            'min' => '',
            'max' => '',
            'allow_in_bindings' => 0,
            'placeholder' => '',
            'step' => 1,
            'prepend' => '',
            'append' => __('month(s)', APP_THEME_DOMAIN),
        );

        $behind_the_scenes_tab = array(
            'key' => 'field_6952a642d1aa0',
            'label' => __('Behind the scenes', APP_THEME_DOMAIN),
            'name' => '',
            'aria-label' => '',
            'type' => 'tab',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'placement' => 'left',
            'endpoint' => 0,
            'selected' => 0,
        );

        $behind_the_scenes_video_status_field = array(
            'key' => 'field_6952a750e5f37',
            'label' => __('Status', APP_THEME_DOMAIN),
            'name' => 'behind_the_video_status',
            'aria-label' => '',
            'type' => 'radio',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '50',
                'class' => '',
                'id' => '',
            ),
            'choices' => array(
                'none' => __('None', APP_THEME_DOMAIN),
                'time' => __('Time', APP_THEME_DOMAIN),
                'content' => __('Content', APP_THEME_DOMAIN),
            ),
            'default_value' => '',
            'return_format' => 'value',
            'allow_null' => 0,
            'other_choice' => 0,
            'allow_in_bindings' => 1,
            'layout' => 'horizontal',
            'save_other_choice' => 0,
        );

        $behind_the_scenes_videos_to_allow_field = array(
            'key' => 'field_6952a7054905a',
            'label' => __('Videos to allow', APP_THEME_DOMAIN),
            'name' => 'videos_to_allow',
            'aria-label' => '',
            'type' => 'number',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => array(
                array(
                    array(
                        'field' => 'field_6952a750e5f37',
                        'operator' => '==',
                        'value' => 'content',
                    ),
                ),
            ),
            'wrapper' => array(
                'width' => '50',
                'class' => '',
                'id' => '',
            ),
            'default_value' => '',
            'min' => '',
            'max' => '',
            'allow_in_bindings' => 0,
            'placeholder' => '',
            'step' => 1,
            'prepend' => '',
            'append' => 'video(s)',
        );

        $behind_the_scenes_amount_of_months_back_field = array(
            'key' => 'field_6952a8i4k9905a',
            'label' => __('Amount of months back', APP_THEME_DOMAIN),
            'name' => 'bts_amount_of_time',
            'aria-label' => '',
            'type' => 'number',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => array(
                array(
                    array(
                        'field' => 'field_6952a750e5f37',
                        'operator' => '==',
                        'value' => 'time',
                    ),
                ),
            ),
            'wrapper' => array(
                'width' => '50',
                'class' => '',
                'id' => '',
            ),
            'default_value' => '',
            'min' => '',
            'max' => '',
            'allow_in_bindings' => 0,
            'placeholder' => '',
            'step' => 1,
            'prepend' => '',
            'append' => 'month(s)',
        );

        $thank_you_message_tab = array(
            'key' => 'field_6952a937abc3b',
            'label' => __('Thank you message', APP_THEME_DOMAIN),
            'name' => '',
            'aria-label' => '',
            'type' => 'tab',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'placement' => 'left',
            'endpoint' => 0,
            'selected' => 0,
        );

        $thank_you_message_status_field = array(
            'key' => 'field_6952a949abc3c',
            'label' => __('Status', APP_THEME_DOMAIN),
            'name' => 'thank_you_message_status',
            'aria-label' => '',
            'type' => 'radio',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'choices' => array(
                'disabled' => __('Disabled', APP_THEME_DOMAIN),
                'enabled' => __('Enabled', APP_THEME_DOMAIN),
            ),
            'default_value' => '',
            'return_format' => 'value',
            'allow_null' => 0,
            'other_choice' => 0,
            'allow_in_bindings' => 1,
            'layout' => 'horizontal',
            'save_other_choice' => 0,
        );

        $thank_you_message_subject_field = array(
            'key' => 'field_6952a9bcabc3e',
            'label' => __('Subject', APP_THEME_DOMAIN),
            'name' => 'thank_you_message_subject',
            'aria-label' => '',
            'type' => 'text',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => array(
                array(
                    array(
                        'field' => 'field_6952a949abc3c',
                        'operator' => '==',
                        'value' => 'enabled',
                    ),
                ),
            ),
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'default_value' => '',
            'maxlength' => '',
            'allow_in_bindings' => 0,
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
        );

        $thank_you_message_content_field = array(
            'key' => 'field_6952a96dabc3d',
            'label' => __('Content', APP_THEME_DOMAIN),
            'name' => 'thank_you_message_content',
            'aria-label' => '',
            'type' => 'wysiwyg',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => array(
                array(
                    array(
                        'field' => 'field_6952a949abc3c',
                        'operator' => '==',
                        'value' => 'enabled',
                    ),
                ),
            ),
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'default_value' => '',
            'allow_in_bindings' => 0,
            'tabs' => 'visual',
            'toolbar' => 'basic',
            'media_upload' => 1,
            'delay' => 0,
        );

        $thank_message_video_status_field = array(
            'key' => 'field_6952b32ec4b0e',
            'label' => __('Thank you video status', APP_THEME_DOMAIN),
            'name' => 'thank_message_video_status',
            'aria-label' => '',
            'type' => 'radio',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => array(
                array(
                    array(
                        'field' => 'field_6952a949abc3c',
                        'operator' => '==',
                        'value' => 'enabled',
                    ),
                ),
            ),
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'choices' => array(
                'disabled' => __('Disabled', APP_THEME_DOMAIN),
                'enabled' => __('Enabled', APP_THEME_DOMAIN),
            ),
            'default_value' => '',
            'return_format' => 'value',
            'allow_null' => 0,
            'other_choice' => 0,
            'allow_in_bindings' => 1,
            'layout' => 'horizontal',
            'save_other_choice' => 0,
        );

        $thank_you_message_thank_you_video_url = array(
            'key' => 'field_6952b2f8c4b0d',
            'label' => __('Video', APP_THEME_DOMAIN),
            'name' => 'thank_you_message_thank_you_video_url',
            'aria-label' => '',
            'type' => 'file',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => array(
                array(
                    array(
                        'field' => 'field_6952b32ec4b0e',
                        'operator' => '==',
                        'value' => 'enabled',
                    ),
                ),
            ),
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'return_format' => 'url',
            'library' => 'all',
            'min_size' => '',
            'max_size' => '',
            'mime_types' => '',
            'allow_in_bindings' => 1,
        );

        $jewellery_tab = array(
            'key' => 'field_6952a9edabc3f',
            'label' => __('Jewellery / Session', APP_THEME_DOMAIN),
            'name' => '',
            'aria-label' => '',
            'type' => 'tab',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'placement' => 'left',
            'endpoint' => 0,
            'selected' => 0,
        );

        $jewellery_status_field = array(
            'key' => 'field_6952aa0aabc40',
            'label' => __('Status', APP_THEME_DOMAIN),
            'name' => 'jewellery_status',
            'aria-label' => '',
            'type' => 'radio',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'choices' => array(
                'none' => __('None', APP_THEME_DOMAIN),
                'discount' => __('Discount', APP_THEME_DOMAIN),
            ),
            'default_value' => 'none',
            'return_format' => 'value',
            'allow_null' => 0,
            'other_choice' => 0,
            'allow_in_bindings' => 1,
            'layout' => 'horizontal',
            'save_other_choice' => 0,
        );

        $jewellery_discount_percentage_field = array(
            'key' => 'field_6952aa1eabc41',
            'label' => __('Discount percentage', APP_THEME_DOMAIN),
            'name' => 'jewellery_discount_percentage',
            'aria-label' => '',
            'type' => 'number',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => array(
                array(
                    array(
                        'field' => 'field_6952aa0aabc40',
                        'operator' => '==',
                        'value' => 'discount',
                    ),
                ),
            ),
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'default_value' => '',
            'min' => '',
            'max' => '',
            'allow_in_bindings' => 0,
            'placeholder' => '',
            'step' => '',
            'prepend' => '',
            'append' => '%',
        );

        $jewellery_discount_amount_of_time_field = array(
            'key' => 'field_6952aa65abc42',
            'label' => __('Discount amount of time', APP_THEME_DOMAIN),
            'name' => 'jewellery_discount_amount_of_time',
            'aria-label' => '',
            'type' => 'number',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => array(
                array(
                    array(
                        'field' => 'field_6952aa0aabc40',
                        'operator' => '==',
                        'value' => 'discount',
                    ),
                ),
            ),
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'default_value' => '',
            'min' => '',
            'max' => '',
            'allow_in_bindings' => 0,
            'placeholder' => '',
            'step' => '',
            'prepend' => '',
            'append' => __('month(s)', APP_THEME_DOMAIN),
        );

        $polaroid_tab = array(
            'key' => 'field_6952abdb5f3a4',
            'label' => __('Polaroid', APP_THEME_DOMAIN),
            'name' => '',
            'aria-label' => '',
            'type' => 'tab',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'placement' => 'left',
            'endpoint' => 0,
            'selected' => 0,
        );

        $polaroid_status_field = array(
            'key' => 'field_6952abea5f3a5',
            'label' => __('Status', APP_THEME_DOMAIN),
            'name' => 'polaroid_status',
            'aria-label' => '',
            'type' => 'radio',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'choices' => array(
                'none' => __('None', APP_THEME_DOMAIN),
                'enabled' => __('Enabled', APP_THEME_DOMAIN),
            ),
            'default_value' => '',
            'return_format' => 'value',
            'allow_null' => 0,
            'other_choice' => 0,
            'allow_in_bindings' => 0,
            'layout' => 'horizontal',
            'save_other_choice' => 0,
        );

        $polaroid_amount_field = array(
            'key' => 'field_6952ac0c5f3a6',
            'label' => __('Amount', APP_THEME_DOMAIN),
            'name' => 'polaroid_amount',
            'aria-label' => '',
            'type' => 'number',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => array(
                array(
                    array(
                        'field' => 'field_6952abea5f3a5',
                        'operator' => '==',
                        'value' => 'enabled',
                    ),
                ),
            ),
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'default_value' => 1,
            'min' => '',
            'max' => '',
            'allow_in_bindings' => 0,
            'placeholder' => '',
            'step' => '',
            'prepend' => '',
            'append' => __('polaroid(s)', APP_THEME_DOMAIN),
        );

        $exclusive_piece_tab = array(
            'key' => 'field_6952abdb5f3b2',
            'label' => __('Exclusive piece', APP_THEME_DOMAIN),
            'name' => '',
            'aria-label' => '',
            'type' => 'tab',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'placement' => 'left',
            'endpoint' => 0,
            'selected' => 0,
        );

        $exclusive_piece_item_field = array(
            'key' => 'field_6952abea5f3c2',
            'label' => __('Item', APP_THEME_DOMAIN),
            'name' => 'exclusive_piece_item',
            'aria-label' => '',
            'type' => 'radio',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'choices' => array(
                'inactive' => __('Inactive', APP_THEME_DOMAIN),
                'active' => __('Active', APP_THEME_DOMAIN),
            ),
            'default_value' => '',
            'return_format' => 'value',
            'allow_null' => 0,
            'other_choice' => 0,
            'allow_in_bindings' => 0,
            'layout' => 'horizontal',
            'save_other_choice' => 0,
        );

        $exclusive_piece_item_amount_field = array(
            'key' => 'field_6952ac0c5f33v1',
            'label' => __('Amount', APP_THEME_DOMAIN),
            'name' => 'exclusive_piece_item_amount',
            'aria-label' => '',
            'type' => 'number',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => array(
                array(
                    array(
                        'field' => 'field_6952abea5f3c2',
                        'operator' => '==',
                        'value' => 'active',
                    ),
                ),
            ),
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'default_value' => 1,
            'min' => '',
            'max' => '',
            'allow_in_bindings' => 0,
            'placeholder' => '',
            'step' => '',
            'prepend' => '',
            'append' => __('piece(s)', APP_THEME_DOMAIN),
        );

        $elementor_tab = array(
            'key' => 'field_6952abdb5f93h',
            'label' => __('Elementor', APP_THEME_DOMAIN),
            'name' => '',
            'aria-label' => '',
            'type' => 'tab',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'placement' => 'left',
            'endpoint' => 0,
            'selected' => 0,
        );

        $elementor_buy_now_button_url_field = array(
            'key' => 'field_6952a9bcab9sio4',
            'label' => __('Buy now button URL', APP_THEME_DOMAIN),
            'name' => 'elementor_buy_now_button_url',
            'aria-label' => '',
            'type' => 'text',
            'instructions' => '',
            'required' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'default_value' => '',
            'maxlength' => '',
            'allow_in_bindings' => 0,
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
        );

        acf_add_local_field_group( array(
            'key' => 'group_695283b19ba96',
            'title' => __('Sponsor Benefits', APP_THEME_DOMAIN),
            'fields' => array(
                $current_content_tab,
                $type_of_access_field,
                $select_content_field,
                $previous_content_for_field,
                $amount_of_videos_field,
                $amount_of_galleries_field,
                $private_gallery_tab,
                $private_gallery_status_field,
                $private_gallery_amount_of_gallery_pictures_field,
                $behind_the_scenes_tab,
                $behind_the_scenes_video_status_field,
                $behind_the_scenes_videos_to_allow_field,
                $behind_the_scenes_amount_of_months_back_field,
                $thank_you_message_tab,
                $thank_you_message_status_field,
                $thank_you_message_subject_field,
                $thank_you_message_content_field,
                $thank_message_video_status_field,
                $thank_you_message_thank_you_video_url,
                $jewellery_tab,
                $jewellery_status_field,
                $jewellery_discount_percentage_field,
                $jewellery_discount_amount_of_time_field,
                $polaroid_tab,
                $polaroid_status_field,
                $polaroid_amount_field,
                $exclusive_piece_tab,
                $exclusive_piece_item_field,
                $exclusive_piece_item_amount_field,
                $elementor_tab,
                $elementor_buy_now_button_url_field,
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'product',
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'left',
            'instruction_placement' => 'label',
            'hide_on_screen' => '',
            'active' => true,
            'description' => '',
            'show_in_rest' => 0,
        ) );
    }

    public function acf_load_buy_now_button_url($value, $post_id, $field): string {
        if(null === $post_id) return '';
        $product_id = str_replace('product_', '', $post_id);
        $checkout_url = apply_filters('wpml_permalink', wc_get_checkout_url(), apply_filters('wpml_current_language', null));
        return $checkout_url . '?add-to-cart=' . $product_id . '&quantity=1';
    }

    public function acf_prepare_buy_now_button($field) : array {
        $field['readonly'] = true;
        return $field;
    }
}
