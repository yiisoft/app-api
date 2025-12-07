<?php

declare(strict_types=1);

use App\Environment;

require_once dirname(__DIR__) . '/vendor/autoload.php';

// Load .env file if it exists (for non-Docker environments)
// Using createUnsafeImmutable() to allow environment variables to override .env values,
// which is the expected behavior (e.g., APP_ENV=test ./yii serve should override .env)
Dotenv\Dotenv::createUnsafeImmutable(dirname(__DIR__))->safeLoad();

Environment::prepare();
