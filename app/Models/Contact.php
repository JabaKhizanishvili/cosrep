<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Contact extends Model
{
    use HasFactory;

    public function getImagePath()
    {
        return '/app/public/contact/';
    }

    public static function getCachedContact()
    {
        return Cache::rememberForever('contact.info', function () {
            return self::first();
        });
    }

    public static function clearCache()
    {
        Cache::forget('contact.info');
    }

    protected static function boot()
    {
        parent::boot();

        static::saved(function () {
            self::clearCache();
        });

        static::deleted(function () {
            self::clearCache();
        });
    }
}
