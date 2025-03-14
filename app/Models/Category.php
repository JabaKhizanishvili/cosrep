<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

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
