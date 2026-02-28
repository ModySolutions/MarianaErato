<?php

namespace App\Hooks;

use Elementor\Core\Files\CSS\Post;
use Elementor\Plugin;
use JetBrains\PhpStorm\NoReturn;

class MyAccount {
    public function init(): void {
        add_shortcode('me_my_account', [$this, 'my_account_buttons_shortcode']);
    }

    public function my_account_buttons_shortcode(): false|string {
        ob_start();

        $template_id = get_field('my_account_buttons_template', 'option');
        $css_file = new Post($template_id);
        $css_file->enqueue();
        if ($template_id && did_action('elementor/loaded')) {
            echo Plugin::instance()->frontend->get_builder_content_for_display($template_id);
        }

        return ob_get_clean();
    }
}