<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Blog extends Model
{
    use HasFactory;
    use HasTranslations;


    public $translatable = ['name', 'text'];
    protected $fillable = ['name', 'text', 'image'];
    public const SORT_ARRAY = [
        'created_at' => 'Created At +',
        'created_at-' => 'Created At -',
    ];

    public function getImagePath()
    {
        return '/app/public/blogs/';
    }
}
