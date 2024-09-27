<?php

namespace RateLimiterLibrary;

class RateLimiter
{
    protected $limit;
    protected $timeWindow;
    protected $storage;

    public function __construct($limit, $timeWindow, StorageInterface $storage)
    {
        $this->limit = $limit;
        $this->timeWindow = $timeWindow;
        $this->storage = $storage;
    }

    public function isAllowed($key)
    {
        $requests = $this->storage->get($key);
        $currentTime = time();

        // Zaman penceresi dışında kalan istekleri temizle
        $requests = array_filter($requests, function($timestamp) use ($currentTime) {
            return ($currentTime - $timestamp) <= $this->timeWindow;
        });

        if (count($requests) < $this->limit) {
            // Yeni isteği ekle ve izin ver
            $requests[] = $currentTime;
            $this->storage->set($key, $requests);
            return true;
        }

        return false;
    }
}
