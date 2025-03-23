<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Spatie\Translatable\HasTranslations;

class Partner extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $fillable = ['name'];
    public $translatable = ['name'];

    public function getImagePath()
    {
        return '/app/public/partners/';
    }

    public static function getCachedPartners()
    {
        return Cache::rememberForever('partners', function () {
            return self::orderBy('id', 'desc')->get();
        });
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

    public static function clearCache()
    {
        Cache::forget("partners"); // მთლიანი მენიუს ქეშის წაშლა
    }
}
