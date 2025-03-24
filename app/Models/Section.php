<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Section extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $fillable = ['title', 'text', 'stats'];
    public $translatable = ['title', 'text', 'stats'];
    protected $casts = [
        'stats' => 'array' // ავტომატური JSON კასტირება
    ];

    // Accessor დამატებითი ვალიდაციისთვის
    public function getStatsAttribute($value)
    {
        if (is_array($value)) {
            return $value;
        }

        $decoded = json_decode($value, true);
        return is_array($decoded) ? $decoded : [];
    }

   
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function getImagePath()
    {
        return '/app/public/sections/';
    }
}
