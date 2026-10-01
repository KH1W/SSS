<?php

namespace App\Support;

use Illuminate\Contracts\Cache\Lock;
use Illuminate\Contracts\Cache\LockProvider;
use Illuminate\Support\Facades\Cache;
use LogicException;

final class RoomLock
{
    public static function make(string $code, int $seconds): Lock
    {
        $store = Cache::store('file')->getStore();

        if (! $store instanceof LockProvider) {
            throw new LogicException('Room cache store must support locks.');
        }

        return $store->lock(
            'room-lock:'.strtoupper(trim($code)),
            $seconds
        );
    }
}
