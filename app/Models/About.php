<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class About extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $fillable = ['title', 'text', 'stats'];
    public $translatable = ['title', 'text', 'stats'];

    public function getImagePath()
    {
        return '/app/public/about/';
    }
}
