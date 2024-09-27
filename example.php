<?php

require_once __DIR__ . '/src/RateLimiter.php';
require_once __DIR__ . '/src/StorageInterface.php';
require_once __DIR__ . '/src/FileStorage.php';

use RateLimiterLibrary\RateLimiter;
use RateLimiterLibrary\FileStorage;

// Create storage folder if not exists
if (!is_dir(__DIR__ . '/storage')) {
    mkdir(__DIR__ . '/storage', 0777, true);
}

$storage = new FileStorage(__DIR__ . '/storage');
$rateLimiter = new RateLimiter(5, 60, $storage); // 5 requests in 60 seconds

$ipAddress = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';

if ($rateLimiter->isAllowed($ipAddress)) {
    // Request is allowed
    echo "Request successful.";
} else {
    // Too many requests
    http_response_code(429); // Too Many Requests
    echo "Rate limit exceeded.";
}
