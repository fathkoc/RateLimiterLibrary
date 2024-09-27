# Rate Limiter Library

## Introduction

This is a simple PHP Rate Limiting library designed to limit API requests or user actions over a defined time window. It helps protect your application from abusive users or bots by controlling the rate of requests.

## Features

- Define a limit on the number of requests per a certain time window.
- Storage-agnostic, supports file storage, but can be extended to use Redis or other storage backends.
- Easy to integrate with any PHP application.

## Usage

1. **Install the library**:

   If you're using composer, you can install it by running:

   ```
 composer require fathkoc/rate-limiter-library
   ```

2. **Basic Example**:

   ```php
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
   ```

3. **Extend Storage**:

   You can create your own storage class by implementing the `StorageInterface` and integrate Redis, Memcached, or any other storage system.

## License

MIT License
