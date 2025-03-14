<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    use HasFactory;

    public const SORT_ARRAY = [
        'trainings' => 'Trainings +',
        'trainings-' => 'Trainings -',
        'created_at' => 'Created At +',
        'created_at-' => 'Created At -',
    ];

    public function trainings()
    {
        return $this->hasMany(Training::class, 'trainer_id');
    }

    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id');
    }

    public function getImagePath()
    {
        return '/app/public/trainers/';
    }

    public function getSignaturePath()
    {
        return '/app/public/signatures/';
    }
}
