<?php

namespace App\Hooks;

class Moodboard {
    private string $post_type = 'moodboard';

    public function init(): void {
        add_action('init', [$this, 'wp_init']);
        add_action('acf/include_fields', [$this, 'acf_include_fields']);
    }

    public function wp_init(): void {
        register_post_type($this->post_type, array(
            'labels' => array(
                'name' => __('Mood boards', APP_THEME_DOMAIN),
                'singular_name' => __('Mood board', APP_THEME_DOMAIN),
                'menu_name' => __('Mood boards', APP_THEME_DOMAIN),
                'all_items' => __('Mood boards', APP_THEME_DOMAIN),
                'edit_item' => __('Edit Mood board', APP_THEME_DOMAIN),
                'view_item' => __('View Mood board', APP_THEME_DOMAIN),
                'view_items' => __('View Mood boards', APP_THEME_DOMAIN),
                'add_new_item' => __('Add new Mood board', APP_THEME_DOMAIN),
                'add_new' => __('Add new Mood board', APP_THEME_DOMAIN),
                'new_item' => __('New Mood board', APP_THEME_DOMAIN),
                'parent_item_colon' => __('Parent Mood board:', APP_THEME_DOMAIN),
                'search_items' => __('Search Mood boards', APP_THEME_DOMAIN),
                'not_found' => __('No moodboards found', APP_THEME_DOMAIN),
                'not_found_in_trash' => __('No moodboards found in trash', APP_THEME_DOMAIN),
                'archives' => __('Mood board Archive', APP_THEME_DOMAIN),
                'attributes' => __('Atributos de Mood board', APP_THEME_DOMAIN),
                'insert_into_item' => __(`Insert into mood board`, APP_THEME_DOMAIN),
                'uploaded_to_this_item' => __('Uploaded to this mood board', APP_THEME_DOMAIN),
                'filter_items_list' => __('Filter mood boards', APP_THEME_DOMAIN),
                'filter_by_date' => __('Filter mood boards by date', APP_THEME_DOMAIN),
                'items_list_navigation' => __('Browse Mood boards list', APP_THEME_DOMAIN),
                'items_list' => __('Mood boards list', APP_THEME_DOMAIN),
                'item_published' => __('Mood board published.', APP_THEME_DOMAIN),
                'item_published_privately' => __('Mood board published privately.', APP_THEME_DOMAIN),
                'item_reverted_to_draft' => __('Mood board set back to draft.', APP_THEME_DOMAIN),
                'item_scheduled' => __('Mood board scheduled.', APP_THEME_DOMAIN),
                'item_updated' => __('Mood board updated.', APP_THEME_DOMAIN),
                'item_link' => __('Link to Mood board', APP_THEME_DOMAIN),
                'item_link_description' => __('A link to a mood board.', APP_THEME_DOMAIN),
            ),
            'public' => true,
            'exclude_from_search' => true,
            'show_in_rest' => false,
            'menu_position' => 3,
            'menu_icon' => 'dashicons-excerpt-view',
            'supports' => array(
                0 => 'title',
                1 => 'editor',
                2 => 'thumbnail',
            ),
            'delete_with_user' => false,
        ));
        register_taxonomy( 'moodboard-status', array(
            0 => $this->post_type,
        ), array(
            'labels' => array(
                'name' => __('Status', APP_THEME_DOMAIN),
                'singular_name' => __('Status', APP_THEME_DOMAIN),
                'menu_name' => __('Status', APP_THEME_DOMAIN),
                'all_items' => __('All Status', APP_THEME_DOMAIN),
                'edit_item' => __('Edit Status', APP_THEME_DOMAIN),
                'view_item' => __('View Status', APP_THEME_DOMAIN),
                'update_item' => __('Update Status', APP_THEME_DOMAIN),
                'add_new_item' => __('add nuevo Status', APP_THEME_DOMAIN),
                'new_item_name' => __('New Status Name', APP_THEME_DOMAIN),
                'search_items' => __('Search Status', APP_THEME_DOMAIN),
                'not_found' => __('No status found', APP_THEME_DOMAIN),
                'no_terms' => __('There are no statuses', APP_THEME_DOMAIN),
                'items_list_navigation' => __('Browse Status list', APP_THEME_DOMAIN),
                'items_list' => __('Status List', APP_THEME_DOMAIN),
                'back_to_items' => __('← Go to status', APP_THEME_DOMAIN),
                'item_link' => __('Link to Status', APP_THEME_DOMAIN),
                'item_link_description' => __('A link to an status', APP_THEME_DOMAIN),
            ),
            'public' => true,
            'hierarchical' => true,
            'publicly_queryable' => false,
            'show_in_menu' => true,
            'show_in_rest' => false,
            'show_tagcloud' => false,
            'show_admin_column' => true,
            'rewrite' => array(
                'hierarchical' => true,
            ),
            'sort' => true,
        ) );
    }

    public function acf_include_fields() : void {

        if ( ! function_exists( 'acf_add_local_field_group' ) ) {
            return;
        }

        acf_add_local_field_group( array(
            'key' => 'group_672e0b6c92f7b',
            'title' => __('Modulos'),
            'fields' => array(
                array(
                    'key' => 'field_672e0b6d53bc5',
                    'label' => __('Subtítulos'),
                    'name' => 'subtitulos',
                    'aria-label' => '',
                    'type' => 'wysiwyg',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'wpml_cf_preferences' => 2,
                    'default_value' => '',
                    'allow_in_bindings' => 0,
                    'tabs' => 'visual',
                    'toolbar' => 'basic',
                    'media_upload' => 0,
                    'delay' => 0,
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'module',
                    ),
                ),
            ),
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
        ) );
    }
}