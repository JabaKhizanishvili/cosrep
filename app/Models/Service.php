<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Service extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $fillable = ['name', 'text'];
    public $translatable = ['name', 'text'];

    public function getImagePath()
    {
        return '/app/public/services/';
    }
}
