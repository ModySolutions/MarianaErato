<?php

namespace App\Hooks;

class Language
{
    public function init(): void
    {
        add_action('init', [$this, 'wp_init'], 0);
        add_filter('locale', [$this, 'locale']);
    }

    public function wp_init() : void
    {
        if (isset($_GET['language']) && function_exists('icl_switch_language')) {
            $lang = sanitize_text_field($_GET['language']);
            $active_languages = apply_filters('wpml_active_languages', null, []);
            if (isset($active_languages[$lang])) {
                do_action('wpml_switch_language', $lang);
            }
        }
    }

    public function locale(string $locale): string
    {
        return $locale;
    }
}
