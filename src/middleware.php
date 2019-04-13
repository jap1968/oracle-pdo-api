<?php
// Application middleware

// e.g: $app->add(new \Slim\Csrf\Guard);
// https://github.com/tuupola/cors-middleware
$app->add(new Tuupola\Middleware\CorsMiddleware([
    "origin" => ["*"],
    "methods" => ["GET", "POST", "PUT", "PATCH", "DELETE"],
    "headers.allow" => ["Accept", "Content-Type", "Authorization", "Origin"],
    "headers.expose" => [],
    "credentials" => true,
    "cache" => 0,
    "logger" => $container['logger']
]));
