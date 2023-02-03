<?php

use App\Kernel;

$_SERVER['REQUEST_URI'] = preg_replace('~^/orbitale_cms~', '', $_SERVER['REQUEST_URI']);

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
