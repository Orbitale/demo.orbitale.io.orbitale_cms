<?php

use App\Kernel;
use Symfony\Component\HttpFoundation\Request;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

return function (array $context) {
    $_SERVER['REQUEST_URI'] = preg_replace('~^/orbitale_cms~', '', $_SERVER['REQUEST_URI']);
    Request::setTrustedProxies([$_SERVER['REMOTE_ADDR']], Request::HEADER_X_FORWARDED_PREFIX);

    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};

