<?php

namespace App\Hooks;

class Gutenberg
{
    public function init(): void
    {
        add_action('after_setup_theme', [$this, 'after_setup_theme']);
        add_action('enqueue_block_editor_assets', [$this, 'enqueue_block_editor_assets']);
        add_filter('allowed_block_types_all', [$this, 'allowed_block_types_all']);
        add_filter('block_categories_all', [$this, 'block_categories_all'], 10, 2);
    }

    public function after_setup_theme(): void
    {
        // @Example: remove_theme_support('core-block-patterns');
    }

    public function enqueue_block_editor_assets(): void
    {
        if (WP_DISABLE_FULLSCREEN_EDITOR) {
            $script = "window.onload = function() { const isFullscreenMode = wp.data.select( 'core/edit-post' ).isFeatureActive( 'fullscreenMode' ); if ( isFullscreenMode ) { wp.data.dispatch( 'core/edit-post' ).toggleFeature( 'fullscreenMode' ); } }";
            wp_add_inline_script('wp-blocks', $script);
        }
    }

    public function allowed_block_types_all($allowed_blocks): bool|array
    {
        return $allowed_blocks;
    }

    public function block_categories_all(array $categories, $post): array
    {
        return $categories;
    }
}
