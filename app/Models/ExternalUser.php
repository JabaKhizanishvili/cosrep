<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ExternalUser extends Authenticatable
{
    use HasFactory;
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'google_id',
        'linkedin_id'
    ];

    public function orders()
    {
        return $this->belongsToMany(TrainingOrder::class, 'training_orders', 'external_user_id' )->with('training')->withPivot('finished_at', 'point_to_pass', 'final_point')->orderBy('start_date', 'desc');
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class,'external_user_id');
    }

    public function isExternal()
    {
        return true;
    }


}
