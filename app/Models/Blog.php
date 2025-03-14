<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    public const SORT_ARRAY = [
        'created_at' => 'Created At +',
        'created_at-' => 'Created At -',
    ];

    public function getImagePath()
    {
        return '/app/public/blogs/';
    }
}
