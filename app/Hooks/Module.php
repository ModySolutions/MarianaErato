<?php

namespace App\Hooks;

class Module {
    private string $post_type = 'module';

    public function init(): void {
        add_action('init', [$this, 'wp_init']);
        add_action('acf/include_fields', [$this, 'acf_include_fields']);
    }

    public function wp_init(): void {
        register_post_type($this->post_type, array(
            'labels' => array(
                'name' => __('Modulos'),
                'singular_name' => __('Modulo'),
                'menu_name' => __('Modulos'),
                'all_items' => __('Todos Modulos'),
                'edit_item' => __('Editar Modulo'),
                'view_item' => __('Ver Modulo'),
                'view_items' => __('Ver Modulos'),
                'add_new_item' => __('Añadir nuevo Modulo'),
                'add_new' => __('Añadir nuevo Modulo'),
                'new_item' => __('Nuevo Modulo'),
                'parent_item_colon' => __('Modulo superior:'),
                'search_items' => __('Buscar Modulos'),
                'not_found' => __('No se han encontrado modulos'),
                'not_found_in_trash' => __('No hay modulos en la papelera'),
                'archives' => __('Archivo de Modulo'),
                'attributes' => __('Atributos de Modulo'),
                'insert_into_item' => __('Insertar en modulo'),
                'uploaded_to_this_item' => __('Subido a este modulo'),
                'filter_items_list' => __('Filtrar lista de modulos'),
                'filter_by_date' => __('Filtrar modulos por fecha'),
                'items_list_navigation' => __('Navegación por la lista de Modulos'),
                'items_list' => __('Lista de Modulos'),
                'item_published' => __('Modulo publicado.'),
                'item_published_privately' => __('Modulo publicado de forma privada.'),
                'item_reverted_to_draft' => __('Modulo devuelto a borrador.'),
                'item_scheduled' => __('Modulo programados.'),
                'item_updated' => __('Modulo actualizado.'),
                'item_link' => __('Enlace a Modulo'),
                'item_link_description' => __('Un enlace a un modulo.'),
            ),
            'public' => true,
            'show_in_rest' => true,
            'menu_icon' => 'dashicons-book-alt',
            'supports' => array(
                'title',
                'author',
                'editor',
                'excerpt',
                'page-attributes',
                'thumbnail',
                'custom-fields',
            ),
            'has_archive' => true,
            'rewrite' => array(
                'feeds' => false,
            ),
            'delete_with_user' => false,
        ));

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