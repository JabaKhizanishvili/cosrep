<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Lang;

class Appointment extends Model
{
    use HasFactory;

    public const STATUS_UPCOMING = 'მომავალი';
    public const STATUS_CLOSED = 'დასრულებული';
    public const STATUS_OPEN = 'მიმდინარე';

    public static function getStatusUpcoming($status)
    {
        switch ($status) {
            case self::STATUS_UPCOMING:
                return Lang::get('page.future');
            case self::STATUS_CLOSED:
                return Lang::get('page.finished');
            case self::STATUS_OPEN:
                return Lang::get('page.current');
            default:
                return false;
        }
    }


    public const SORT_ARRAY = [
        'customers' => 'Customers +',
        'customers-' => 'Customers -',
        'created_at' => 'Created At +',
        'created_at-' => 'Created At -',
        'start_date' => 'Start Date +',
        'start_date-' => 'Start Date -',
    ];

    public function scopeNeedsToReport($query)
    {
        return $query->where('reported', false);
    }


    public function isOpen()
    {
        $start_date = date("Y-m-d H:i:s", strtotime($this->start_date));
        $end_date = date("Y-m-d H:i:s", strtotime($this->end_date));
        $current = date("Y-m-d H:i:s");

        return $start_date <= $current && $end_date > $current ? true : false;
    }

    public function isDone()
    {
        $end_date = date("Y-m-d H:i:s", strtotime($this->end_date));
        $current = date("Y-m-d H:i:s");

        return $end_date < $current ? true : false;
    }

    public function isFinishedByCustomer()
    {
        return !empty($this->pivot->finished_at) ? true : false;
    }

    public function isFuture()
    {
        $start_date = date("Y-m-d H:i:s", strtotime($this->start_date));
        $current = date("Y-m-d H:i:s");

        return $start_date > $current ? true : false;
    }

    public function scopeOpen($query)
    {
        $current = date("Y-m-d H:i:s");

        return $query->where('start_date', '<=', $current)->where('end_date', '>', $current);
    }

    public function scopeAll($query)
    {
        return $query;
    }

    public function scopeFuture($query)
    {
        $current = date("Y-m-d H:i:s");

        return $query->where('start_date', '>', $current);
    }

    public function getStatus()
    {
        $start_date = date("Y-m-d H:i:s", strtotime($this->start_date));
        $end_date = date("Y-m-d H:i:s", strtotime($this->end_date));
        $current = date("Y-m-d H:i:s");
        $result = '';


        if ($start_date > $current) {
            $status = self::STATUS_UPCOMING;
            $translatedStatus = $this->getStatusUpcoming($status);
            $result = $result = "<span class='btn btn-warning text-white pt-1 pb-1'>$translatedStatus</span>";
        } elseif ($start_date <= $current && $end_date > $current) {
            $status = self::STATUS_OPEN;
            $translatedStatus = $this->getStatusUpcoming($status);
            $result = $result = "<span class='btn btn-success text-white pt-1 pb-1'>$translatedStatus</span>";
        } elseif ($end_date < $current) {
            $status = self::STATUS_CLOSED;
            $translatedStatus = $this->getStatusUpcoming($status);
            $result = $result = "<span class='btn btn-danger text-white pt-1 pb-1'>$translatedStatus</span>";
        }
        return $result;
    }


    public const REPEAT_STATUS_REPEATED = 1;
    public const REPEAT_STATUS_NOT_REPEATED = 2;


    public function training()
    {
        return $this->belongsTo(Training::class, 'training_id');
    }

    public function customers()
    {
        return $this->hasMany(AppointmentCustomer::class, 'appointment_id')->with('customer', 'customer.office');
    }

    public function scopeInFuture($query)
    {
        return $query->whereDate('start_date', '>', date("Y-m-d H:i"));
    }

    public function scopeInPast($query)
    {
        return $query->whereDate('start_date', '<', date("Y-m-d H:i"));
    }

    public function canBeUpdated()
    {
        $earlier = new DateTime($this->start_date);
        $later = new DateTime(date("Y-m-d H:i"));
        $abs_diff = $later->diff($earlier)->format("%a"); //3

        return $abs_diff > 1;
    }

    public function getDuration()
    {
        $earlier = new DateTime($this->start_date);
        $later = new DateTime($this->end_date);
        $abs_diff = $later->diff($earlier)->format("%h"); //3
        return $abs_diff;
    }

    public function repeatStartDate()
    {
        $date = date("Y-m-d H:i:s", strtotime("$this->start_date + $this->repeat Month"));
        return $date;
    }

    public function repeatEndDate()
    {
        $date = date("Y-m-d H:i:s", strtotime("$this->end_date + $this->repeat Month"));
        return $date;
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function scopeDone($query)
    {
        return $query->where('end_date', '<', date("Y-m-d H:i:s"));
    }

    public function getStartDate()
    {
        return date("Y-M-d H:i", strtotime($this->start_date));
    }

    public function getEndDate()
    {
        return date("Y-M-d H:i", strtotime($this->end_date));
    }

    public function canBeEdited()
    {
        //check if appointment can be changed
        $appointment_can_be_edited_before = config('meta.appointment_can_be_edited_before');

        $appointment_start_date = date("Y-m-d", strtotime($this->start_date));
        $today = date("Y-m-d");

        $earlier = new DateTime($appointment_start_date);
        $later = new DateTime($today);
        $abs_diff = $later->diff($earlier)->format("%a");

        if ($abs_diff < $appointment_can_be_edited_before) {
            return false;
        }

        return true;
    }

    public function getColorAttribute()
    {
        return '#e7515a';
    }
}
