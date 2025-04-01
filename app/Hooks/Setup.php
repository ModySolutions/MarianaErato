<?php

namespace App\Hooks;

class Setup {
    public function init(): void {
        if (DISALLOW_INDEXING !== true) {
            return;
        }
        add_action('admin_init', [$this, 'admin_init']);
        add_action('admin_menu', [$this, 'admin_menu'], 99999);
        add_action('pre_option_blog_public', '__return_zero');

        add_filter('burst_menu_position', fn($position) => 58);
    }

    public function admin_init(): void {
        if (!apply_filters('app/disallow_indexing_admin_notice', true)) {
            return;
        }

        add_action('admin_notices', function () {
            $message =
                sprintf(__('%1$s Search engine indexing has been discouraged because the current environment is %2$s.',
                        'roots'), '<strong>Boilerplate:</strong>', '<code>'.WP_ENV.'</code>',);
            echo "<div class='notice notice-warning'><p>{$message}</p></div>";
        });
    }

    public function admin_menu(): void {
        if(WP_ENV === 'local') {
            remove_menu_page('filebird-settings');
            remove_menu_page('edit.php?post_type=acf-field-group');
            remove_menu_page('postman');
            remove_menu_page('wpseo_dashboard');
            remove_menu_page('complianz');
            remove_menu_page('wc_pay_per_post');
            remove_menu_page('tm/menu/main.php');
            remove_menu_page('admin.php?page=wc-admin&task=payments');
            remove_menu_page('elementor');
        }
    }
}
