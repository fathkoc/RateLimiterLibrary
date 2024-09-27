<?php

namespace RateLimiterLibrary;

class FileStorage implements StorageInterface
{
    protected $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function get($key)
    {
        $file = $this->path . '/' . md5($key) . '.json';
        if (!file_exists($file)) {
            return [];
        }

        $data = file_get_contents($file);
        return json_decode($data, true) ?? [];
    }

    public function set($key, $data)
    {
        $file = $this->path . '/' . md5($key) . '.json';
        file_put_contents($file, json_encode($data));
    }
}
