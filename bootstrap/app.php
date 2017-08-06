<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Exception\InvalidPathException;

try {
    (new Dotenv\Dotenv(__DIR__ . '/../'))->load();
} catch (InvalidPathException $e) {
    throw new InvalidPathException($e->getMessage());
}

$app = new Slim\App([
    'settings' => include __DIR__ . '/../config/app.php'
]);

require __DIR__ . '/container.php';

require __DIR__ . '/../routes/web.php';

$capsule = $app->getContainer()->get('capsule');
$capsule->bootEloquent();
