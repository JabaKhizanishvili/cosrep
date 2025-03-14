<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentCustomer extends Model
{
    use HasFactory;


    protected $fillable = [
        'appointment_id',
        'customer_id',
        'finished_at'
    ];

    public const NOTIFIED_ONE = 1;
    public const NOTIFIED_TWO = 2;

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function scopeNeedsToReport($query)
    {
        return $query->where('reported', false);
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'appointment_id');
    }

    public function passed()
    {
        if (empty($this->final_point)) {
            return false;
        }
        return $this->final_point >= $this->point_to_pass ? true : false;
    }

    public function scopePassed($query)
    {
        return $query->where('final_point', '!=', null)->whereRaw('final_point >= point_to_pass');
    }

    public function scopeNotifyOne($query)
    {
        return $query->whereNull('notified');
    }

    public function scopeNotifyTwo($query)
    {
        return $query->where('notified', self::NOTIFIED_ONE);
    }
}
