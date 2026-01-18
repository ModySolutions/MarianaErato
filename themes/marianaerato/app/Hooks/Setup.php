<?php

namespace App\Hooks;

class Setup
{
    public function init(): void
    {
        if (defined('DISALLOW_INDEXING') && DISALLOW_INDEXING === true) {
            add_action('admin_init', [$this, 'admin_init'], 99999);
            add_action('pre_option_blog_public', '__return_zero');
        }

        add_action('admin_menu', [$this, 'admin_menu'], 99999);

        remove_action('after_plugin_row_acfml/wpml-acf.php', [\OTGS_Installer_Plugins_Page_Notice::class, 'show_purchase_notice_under_plugin']);
        remove_action('after_plugin_row_wpml-cms-nav/plugin.php', [\OTGS_Installer_Plugins_Page_Notice::class, 'show_purchase_notice_under_plugin']);
        remove_action('after_plugin_row_sitepress-multilingual-cms/sitepress.php', [\OTGS_Installer_Plugins_Page_Notice::class, 'show_purchase_notice_under_plugin']);
        remove_action('after_plugin_row_wp-seo-multilingual/plugin.php', [\OTGS_Installer_Plugins_Page_Notice::class, 'show_purchase_notice_under_plugin']);
        remove_action('after_plugin_row_wpml-string-translation/plugin.php', [\OTGS_Installer_Plugins_Page_Notice::class, 'show_purchase_notice_under_plugin']);
        remove_action('admin_menu', [\Admin_Display::class, 'register_admin_menu']);
    }

    public function admin_init(): void
    {
        if (!apply_filters('app/disallow_indexing_admin_notice', true)) {
            return;
        }

        add_action('admin_notices', function () {
            $message =
                sprintf(__(
                    '%1$s Search engine indexing has been discouraged because the current environment is %2$s.',
                    'roots',
                ), '<strong>Boilerplate:</strong>', '<code>' . WP_ENV . '</code>', );
            echo "<div class='notice notice-warning'><p>{$message}</p></div>";
        });
    }

    public function admin_menu(): void
    {
        if (WP_ENV === 'production') {
            remove_menu_page('filebird-settings');
            remove_menu_page('edit.php?post_type=acf-field-group');
            remove_menu_page('postman');
            remove_menu_page('wpseo_dashboard');
            remove_menu_page('complianz');
            remove_menu_page('wc_pay_per_post');
            remove_menu_page('admin.php?page=wc-admin&task=payments');
            //remove_menu_page('elementor');
            remove_menu_page('admin.php?page=litespeed');
            remove_menu_page('admin.php?page=really-simple-security');
        }
    }
}
