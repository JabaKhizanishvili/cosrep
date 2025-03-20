<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Page extends Model
{
    use HasFactory;

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeDisplay($query)
    {
        return $query->where('display_in_menu', 1);
    }

    public function isMainPage()
    {
        return $this->display_in_menu == 1 ? true : false;
    }

    public function scopePolicies($query)
    {
        return $query->whereIn('id', [9, 10]);
    }

    public function getImagePath()
    {
        return '/app/public/pages/';
    }

    public static function getCachedPages()
    {
        return Cache::rememberForever('pages.all', function () {
            return self::active()->get();
        });
    }

    public static function getCachedPageBySlug($slug)
    {
        return Cache::rememberForever("page.{$slug}", function () use ($slug) {
            return self::where('slug', $slug)->first();
        });
    }

    public static function getCachedMenuPages()
    {
        return Cache::rememberForever('pages.all', function () {
            return self::active()->display()->orderBy('position', 'asc')->get();
        });
    }

    // ქეშის გასუფთავება ცვლილებებისას
    protected static function boot()
    {
        parent::boot();

        static::saved(function ($page) {
            self::clearCache($page);
        });

        static::deleted(function ($page) {
            self::clearCache($page);
        });
    }

    public static function clearCache()
    {
        Cache::forget("pages.all"); // მთლიანი მენიუს ქეშის წაშლა
    }

}
