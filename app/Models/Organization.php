<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    public const SORT_ARRAY = [
        'offices' => 'Offices +',
        'offices-' => 'Offices -',
        'created_at' => 'Created At +',
        'created_at-' => 'Created At -',
    ];

    public function offices()
    {
        return $this->hasMany(Office::class, 'organization_id');
    }
}
