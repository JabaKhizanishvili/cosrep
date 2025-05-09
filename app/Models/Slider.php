<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Slider extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['name'];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function getImagePath()
    {
        return '/app/public/sliders/';
    }
}
