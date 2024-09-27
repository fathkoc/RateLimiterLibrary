<?php

namespace RateLimiterLibrary;

interface StorageInterface
{
    public function get($key);
    public function set($key, $data);
}
