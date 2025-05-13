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
        'access_expires_at',
        'paid_at',
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

    public function isFinishedByCustomer()
    {
        return !empty($this->pivot->finished_at) ? true : false;
    }

    public function passed()
    {
        if (empty($this->final_point)) {
            return false;
        }
        return $this->final_point >= $this->point_to_pass ? true : false;
    }

    public static function getTypeOptions()
    {
        return [
            'online' => 'Online',
            'offline' => 'Offline',
        ];
    }

    public function isDone()
    {
        $end_date = date("Y-m-d H:i:s", strtotime($this->end_date));
        $current = date("Y-m-d H:i:s");

        return $end_date < $current ? true : false;
    }

    public function isOpen()
    {
        $start_date = date("Y-m-d H:i:s", strtotime($this->paid_at));
        $end_date = date("Y-m-d H:i:s", strtotime($this->access_expires_at));
        $current = date("Y-m-d H:i:s");

        return $start_date <= $current && $end_date > $current ? true : false;
    }
}
