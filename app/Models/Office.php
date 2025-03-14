<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use HasFactory;

    public const SORT_ARRAY = [
        'customers' => 'Customers +',
        'customers-' => 'Customers -',
        'created_at' => 'Created At +',
        'created_at-' => 'Created At -',
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }

    public function customers()
    {
        return $this->hasMany(Customer::class, 'office_id');
    }
}
