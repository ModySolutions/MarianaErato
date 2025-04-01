<?php
use function Env\env;

define('SAVEQUERIES', true);
define('WP_DEBUG', true);
define('WP_DEBUG_DISPLAY', true);
define('WP_DEBUG_LOG', env('WP_DEBUG_LOG'));
define('WP_DISABLE_FATAL_ERROR_HANDLER', true);
define('SCRIPT_DEBUG', true);
define('DISALLOW_INDEXING', true);

ini_set('display_errors', '1');

// Enable plugin and theme updates and installation from the admin
define('DISALLOW_FILE_MODS', true);

define('SMTP_HOST', env('SMTP_HOST') ?? null);
define('SMTP_AUTH', env('SMTP_AUTH') ?? null);
define('SMTP_PORT', env('SMTP_PORT') ?? null);
define('SMTP_USERNAME', env('SMTP_USERNAME') ?? null);
define('SMTP_PASSWORD', env('SMTP_PASSWORD') ?? null);