<?php

require_once dirname(__FILE__).'/vendor/autoload.php';

use App\App;
use function Env\env;
Env\Env::$options = 31;
$root_dir = dirname(__FILE__);

if (file_exists($root_dir . '/.env')) {
    $env_files = file_exists($root_dir . '/.env.local')
        ? ['.env', '.env.local']
        : ['.env'];

    $repository = Dotenv\Repository\RepositoryBuilder::createWithNoAdapters()
        ->addAdapter(Dotenv\Repository\Adapter\EnvConstAdapter::class)
        ->addAdapter(Dotenv\Repository\Adapter\PutenvAdapter::class)
        ->immutable()
        ->make();

    $dotenv = Dotenv\Dotenv::create($repository, $root_dir, $env_files, false);
    $dotenv->load();
}

define('THEME_URI', trailingslashit(get_stylesheet_directory_uri()));

$glob = glob(__DIR__.DIRECTORY_SEPARATOR.'acf'.DIRECTORY_SEPARATOR.'*.php');
if (count($glob) > 0) {
    foreach ($glob as $file) {
        if (file_exists($file)) {
            require_once $file;
        }
    }
}

add_action('woocommerce_checkout_create_order', function ($order, $data) {
    $items = $order->get_items();

    foreach ($items as $item_id => $item) {
        $product_id = $item->get_product_id();
        $product_url = get_permalink($product_id);
        $order->update_meta_data('product_url', $product_url);
    }
}, 10, 2);

add_filter('http_request_host', function ($url, $type = '', $args = null, $url_type = '') {
    $blocked_domains = array(
        'api.wordpress.org',
        'downloads.wordpress.org',
        'wordpress.org',
    );

    foreach ($blocked_domains as $blocked_domain) {
        if (str_contains($url, $blocked_domain)) {
            return new \WP_Error('blocked_connection', __('Connection blocked to wordpress.org', 'your-text-domain'));
        }
    }

    return $url;
});

add_filter('pre_http_request', function ($a) {
    return false;
});

if (!defined('WP_ENV')) {
    define('WP_ENV', env('WP_ENV') ?? 'local');
};

define('APP_THEME_DOMAIN', 'mariana-erato');
define('APP_THEME_DIR', trailingslashit(get_template_directory()));
define('APP_THEME_URL', trailingslashit(get_template_directory_uri()));
define('APP_PATH', trailingslashit(APP_THEME_DIR.'app'));
define('APP_RESOURCES_PATH', APP_THEME_DIR . 'resources/views');
define('APP_TEMPLATES', array());
define('WP_DISABLE_FULLSCREEN_EDITOR', false);
define('SENDGRID_API_URL', env('SENDGRID_API_URL') ?? false);
define('SENDGRID_API_KEY', env('SENDGRID_API_KEY') ?? false);
define('EMAIL_FROM', env('EMAIL_FROM') ?? false);
define('EMAIL_FROM_NAME', env('EMAIL_FROM_NAME') ?? false);
define('DISALLOW_INDEXING', env('DISALLOW_INDEXING') ?? false);

App::start();
