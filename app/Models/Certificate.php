<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;
    protected $fillable = [
        'external_user_id',
        'training_id',
        'file_path',
        'generated_at',
        'downloaded_at',
    ];

    public function user() {
        return $this->belongsTo(ExternalUser::class,'external_user_id');
    }

    public function training() {
        return $this->belongsTo(Training::class, 'training_id');
    }
}
