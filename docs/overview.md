# Rate Limiter Library Documentation

## Overview

This document covers how to use the Rate Limiting library in your PHP projects. The library is designed to protect your application from excessive requests by limiting the number of requests allowed in a given time frame.

### Concepts

- **Rate Limiting**: Controlling the number of requests a user or system can make within a given time window.
- **Storage Backend**: The mechanism used to store request counts and timestamps. By default, the library supports file storage, but you can extend it to use Redis, Memcached, or other storage systems.

### How It Works

The library tracks requests made by users (or IP addresses) and compares the number of requests to a predefined limit. If the number of requests exceeds the limit within the set time window, further requests are blocked.

### API Reference

- `RateLimiter::__construct($limit, $timeWindow, StorageInterface $storage)`: Initialize the rate limiter with a maximum number of requests (`$limit`) and a time window in seconds (`$timeWindow`). 
- `RateLimiter::isAllowed($key)`: Check if a request with a specific key (e.g., an IP address or user ID) is allowed based on the defined limit and time window.
