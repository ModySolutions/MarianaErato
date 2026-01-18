<?php

require_once dirname(__FILE__) . '/vendor/autoload.php';

use App\App;

require_once trailingslashit(__DIR__) . 'config/application.php';

App::start();
