<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Instant Ultra-Fast Image & Storage File Delivery
if (isset($_SERVER['REQUEST_URI'])) {
    $reqPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    if (preg_match('#^/storage/(.+)$#', $reqPath, $m)) {
        $filePath = __DIR__ . '/storage/app/public/' . $m[1];
        if (file_exists($filePath) && is_file($filePath)) {
            $ext = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
            $mimes = [
                'jpg' => 'image/jpeg',
                'jpeg' => 'image/jpeg',
                'png' => 'image/png',
                'webp' => 'image/webp',
                'gif' => 'image/gif',
                'svg' => 'image/svg+xml',
            ];
            $mime = $mimes[$ext] ?? (mime_content_type($filePath) ?: 'application/octet-stream');
            header('Content-Type: ' . $mime);
            header('Content-Length: ' . filesize($filePath));
            header('Cache-Control: public, max-age=31536000');
            readfile($filePath);
            exit;
        }
    }
}

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/storage/framework/maintenance.php')) {
    require $maintenance;
} elseif (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
if (file_exists(__DIR__.'/vendor/autoload.php')) {
    require __DIR__.'/vendor/autoload.php';
} elseif (file_exists(__DIR__.'/../vendor/autoload.php')) {
    require __DIR__.'/../vendor/autoload.php';
}

// Bootstrap Laravel and handle the request...
/** @var Application $app */
if (file_exists(__DIR__.'/bootstrap/app.php')) {
    $app = require_once __DIR__.'/bootstrap/app.php';
} elseif (file_exists(__DIR__.'/../bootstrap/app.php')) {
    $app = require_once __DIR__.'/../bootstrap/app.php';
}

$app->handleRequest(Request::capture());
