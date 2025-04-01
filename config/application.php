<?php

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

/**
 * Theme Config Constants
 */
define('WP_DISABLE_FULLSCREEN_EDITOR', false);
define('APP_THEME_DOMAIN', 'mariana-erato');
define('APP_THEME_DIR', trailingslashit(get_stylesheet_directory()));
define('APP_THEME_URL', trailingslashit(get_stylesheet_directory_uri()));
define('APP_PATH', trailingslashit(APP_THEME_DIR . 'app'));
define('APP_RESOURCES_PATH', APP_THEME_DIR . 'resources/views');
define('APP_TEMPLATES', []);
define('APP_REMOVE_ADMIN_MENUS', env('APP_REMOVE_ADMIN_MENUS') ?? false);

/**
 * Email Config Constants
 */
define('SENDGRID_API_URL', env('SENDGRID_API_URL') ?? false);
define('SENDGRID_API_KEY', env('SENDGRID_API_KEY') ?? false);
define('EMAIL_FROM', env('EMAIL_FROM') ?? false);
define('EMAIL_FROM_NAME', env('EMAIL_FROM_NAME') ?? false);

/**
 * Security Config Constants
 */
define('RECAPTCHA_KEY', env('RECAPTCHA_KEY') ?? false);
define('RECAPTCHA_SECRET', env('RECAPTCHA_SECRET') ?? false);
