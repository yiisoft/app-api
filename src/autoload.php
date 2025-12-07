<?php

declare(strict_types=1);

use App\Environment;

require_once dirname(__DIR__) . '/vendor/autoload.php';

// Load .env file if it exists (for non-Docker environments)
$dotenv = Dotenv\Dotenv::createUnsafeImmutable(dirname(__DIR__));
$dotenv->safeLoad();

Environment::prepare();
