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

}
