<?php

namespace App\Hooks;

use Timber\Timber;

class Security
{
    public function init(): void
    {
        add_action('wp_head', [$this, 'add_recaptcha']);
        add_action('admin_menu', [$this, 'admin_menu']);

        add_filter('translations_api', '__return_true');
        add_filter('pre_site_transient_update_plugins', '__return_null');
        add_filter('pre_site_transient_update_themes', '__return_null');
        add_filter('pre_site_transient_update_core', '__return_null');

        remove_action('wp_head', 'rest_output_link_wp_head', 10);
        remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
        remove_action('template_redirect', 'rest_output_link_header', 10);

        remove_action('admin_init', '_maybe_update_core');
        remove_action('wp_version_check', 'wp_version_check');

        remove_action('load-plugins.php', 'wp_update_plugins');
        remove_action('load-update.php', 'wp_update_plugins');
        remove_action('load-update-core.php', 'wp_update_plugins');
        remove_action('admin_init', '_maybe_update_plugins');
        remove_action('wp_update_plugins', 'wp_update_plugins');

        remove_action('load-themes.php', 'wp_update_themes');
        remove_action('load-update.php', 'wp_update_themes');
        remove_action('load-update-core.php', 'wp_update_themes');
        remove_action('admin_init', '_maybe_update_themes');
        remove_action('wp_update_themes', 'wp_update_themes');

        remove_action('update_option_WPLANG', 'wp_clean_update_cache', 10, 0);
        remove_action('wp_maybe_auto_update', 'wp_maybe_auto_update');
        remove_action('init', 'wp_schedule_update_checks');
        remove_action('wp_delete_temp_updater_backups', 'wp_delete_all_temp_backups');
    }

    public function admin_menu() : void {
        remove_action('admin_notices', 'update_nag', 3);
    }

    public static function add_recaptcha(): void
    {
        if (is_singular()) {
            global $post;
            $blocks = parse_blocks($post->post_content);
            if ($blocks && is_array($blocks)) {

                $add_script = function () {
                    $recaptcha_site_key = RECAPTCHA_KEY;
                    $recaptcha_site_secret = RECAPTCHA_SECRET;

                    if (!$recaptcha_site_key || !$recaptcha_site_secret) {
                        return;
                    }

                    echo Timber::compile('@app/components/tags/script.twig', [
                        'id' => 'google-recaptcha',
                        'src' => add_query_arg([
                            'render' => $recaptcha_site_key,
                        ], 'https://www.google.com/recaptcha/api.js'),
                        'defer' => true,
                    ]);
                };

                $protected_pages = [];
                foreach ($blocks as $block) {
                    if (in_array($block['blockName'], $protected_pages)) {
                        $add_script();
                        return;
                    }
                }
            }
        }
    }
}
