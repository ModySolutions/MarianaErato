<?php

add_action( 'init', function() {
    register_post_type( 'moodboard', array(
        'labels' => array(
            'name' => __('Moodboards'),
            'singular_name' => __('Moodboard'),
            'menu_name' => __('Moodboards'),
            'all_items' => __('Moodboards'),
            'edit_item' => __('Editar Moodboard'),
            'view_item' => __('Ver Moodboard'),
            'view_items' => __('Ver Moodboards'),
            'add_new_item' => __('Añadir nuevo Moodboard'),
            'add_new' => __('Añadir nuevo Moodboard'),
            'new_item' => __('Nuevo Moodboard'),
            'parent_item_colon' => __('Moodboard superior:'),
            'search_items' => __('Buscar Moodboards'),
            'not_found' => __('No se han encontrado moodboards'),
            'not_found_in_trash' => __('No hay moodboards en la papelera'),
            'archives' => __('Archivo de Moodboard'),
            'attributes' => __('Atributos de Moodboard'),
            'insert_into_item' => __('Insertar en moodboard'),
            'uploaded_to_this_item' => __('Subido a este moodboard'),
            'filter_items_list' => __('Filtrar lista de moodboards'),
            'filter_by_date' => __('Filtrar moodboards por fecha'),
            'items_list_navigation' => __('Navegación por la lista de Moodboards'),
            'items_list' => __('Lista de Moodboards'),
            'item_published' => __('Moodboard publicado.'),
            'item_published_privately' => __('Moodboard publicado de forma privada.'),
            'item_reverted_to_draft' => __('Moodboard devuelto a borrador.'),
            'item_scheduled' => __('Moodboard programados.'),
            'item_updated' => __('Moodboard actualizado.'),
            'item_link' => __('Enlace a Moodboard'),
            'item_link_description' => __('Un enlace a un moodboard.'),
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
    ) );
} );

add_action( 'init', function() {
    register_taxonomy( 'moodboard-status', array(
        0 => 'moodboard',
    ), array(
        'labels' => array(
            'name' => 'Estatus',
            'singular_name' => 'Estatus',
            'menu_name' => 'Estatus',
            'all_items' => 'Todos Estatus',
            'edit_item' => 'Editar Estatus',
            'view_item' => 'Ver Estatus',
            'update_item' => 'Actualizar Estatus',
            'add_new_item' => 'Añadir nuevo Estatus',
            'new_item_name' => 'Nombre del nuevo Estatus',
            'search_items' => 'Buscar Estatus',
            'not_found' => 'No se han encontrado estatus',
            'no_terms' => 'No hay estatus',
            'items_list_navigation' => 'Navegación por la lista de Estatus',
            'items_list' => 'Lista de Estatus',
            'back_to_items' => '← Ir a estatus',
            'item_link' => 'Enlace a Estatus',
            'item_link_description' => 'Un enlace a un estatus',
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
} );

