<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['title'];

    public function trainings()
    {
        return $this->hasMany(Training::class, 'category_id');
    }

    public function frontTrainings()
    {
        return $this->hasMany(Training::class, 'category_id')->active();
    }

    public function getImagePath()
    {
        return '/app/public/categories/';
    }
}
