<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeDisplay($query)
    {
        return $query->where('display_in_menu', 1);
    }

    public function isMainPage()
    {
        return $this->display_in_menu == 1 ? true : false;
    }

    public function scopePolicies($query)
    {
        return $query->whereIn('id', [9, 10]);
    }

    public function getImagePath()
    {
        return '/app/public/pages/';
    }
}
