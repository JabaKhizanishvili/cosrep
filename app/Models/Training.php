<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Training extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['title', 'text'];

    public const SORT_ARRAY = [
        // 'customers' => 'Customers +',
        // 'customers-' => 'Customers -',
        'created_at' => 'Created At +',
        'created_at-' => 'Created At -',
    ];

    public const FILTER_BY_TEST_STATUS = [
        '1' => 'Yes',
        '2' => 'No',
    ];


    public function trainer()
    {
        return $this->belongsTo(Trainer::class, 'trainer_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function tests()
    {
        return $this->hasMany(TrainingTest::class, 'training_id');
    }

    public function media()
    {
        return $this->hasMany(TrainingMedia::class, 'training_id')->orderBy('position', 'asc');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function getImagePath()
    {
        return '/app/public/trainings/';
    }
}
