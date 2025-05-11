<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'external_user_id',
        'training_id',
        'type',
        'status',
        'test',
        'answers',
        'id_number',
        'phone',
    ];

    public function customer()
    {
        return $this->belongsTo(ExternalUser::class, 'external_user_id');
    }
    public function training(){
        return $this->belongsTo(Training::class, 'training_id');
    }

    const SORT_ARRAY = [
        'latest' => 'Latest First',
        'oldest' => 'Oldest First',
        'status_asc' => 'Status (A-Z)',
        'status_desc' => 'Status (Z-A)',
    ];

    public static function getStatusOptions()
    {
        return [
            'pending' => 'pending',
            'paid' => 'paid',
            'expired' => 'expired',
            'cancelled' => 'cancelled',
        ];
    }

    public static function getTypeOptions()
    {
        return [
            'online' => 'Online',
            'offline' => 'Offline',
        ];
    }
}
