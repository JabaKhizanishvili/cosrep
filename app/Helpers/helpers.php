<?php

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;

function admin_styles($path)
{
    return '/admin_styles/' . $path;
}

function front_styles($path)
{
    return '/front_styles/' . $path;
}

function limit_words($text, $limit)
{
    if (mb_strlen($text) > $limit) {
        return mb_substr($text, 0, $limit) . '...';
    } else {
        return $text;
    }
}

// function randColor()
// {
//     return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
// }

function randColor($num)
{
    $hash = md5('color' . $num); // modify 'color' to get a different palette
    return array(
        hexdec(substr($hash, 0, 2)), // r
        hexdec(substr($hash, 2, 2)), // g
        hexdec(substr($hash, 4, 2))
    ); //b
}

function thumb($object)
{
    if (!File::exists(storage_path('app/public/thumb/' . $object))) {
        $object = 'noimage.jpg';

        return asset('/' . $object);
    } else {
        return asset('/storage/thumb/' . $object);
    }
}

function customerImage($object) //+
{
    if (!File::exists(storage_path('app/public/customers/' . $object))) {
        $object = 'noimage.jpg';

        return asset('/' . $object);
    } else {
        return asset('/storage/customers/' . $object);
    }
}

function pageImage($object)
{
    if (!File::exists(storage_path('app/public/pages/' . $object))) {
        $object = 'noimage.jpg';

        return asset('/' . $object);
    } else {
        return asset('/storage/pages/' . $object);
    }
}

function aboutImage($object)
{
    if (!File::exists(storage_path('app/public/about/' . $object))) {
        $object = 'noimage.jpg';

        return asset('/' . $object);
    } else {
        return asset('/storage/about/' . $object);
    }
}

function contactImage($object)
{
    if (!File::exists(storage_path('app/public/contact/' . $object))) {
        $object = 'noimage.jpg';

        return asset('/' . $object);
    } else {
        return asset('/storage/contact/' . $object);
    }
}

function amazon_s3_url($path)
{
    return config("meta.amazon_s3_url") . $path;
}

function trainerImage($object)
{
    if (!File::exists(storage_path('app/public/trainers/' . $object))) {
        $object = 'noimage.jpg';

        return asset('/' . $object);
    } else {
        return asset('/storage/trainers/' . $object);
    }
}

function sliderImage($object)
{
    if (!File::exists(storage_path('app/public/sliders/' . $object))) {
        $object = 'noimage.jpg';

        return asset('/' . $object);
    } else {
        return asset('/storage/sliders/' . $object);
    }
}

function partnerImage($object)
{
    if (!File::exists(storage_path('app/public/partners/' . $object))) {
        $object = 'noimage.jpg';

        return asset('/' . $object);
    } else {
        return asset('/storage/partners/' . $object);
    }
}

function montName($month)
{

    $data = [
        '01' => 'იან',
        '02' => 'თებ',
        '03' => 'მარ',
        '04' => 'აპრ',
        '05' => 'მაი',
        '06' => 'ივნ',
        '07' => 'ივლ',
        '08' => 'აგვ',
        '09' => 'სექ',
        '10' => 'ოქტ',
        '11' => 'ნოემ',
        '12' => 'დეკ',
    ];

    return $data[$month] ?? ' ';
}

function sectionImage($object)
{
    if (!File::exists(storage_path('app/public/sections/' . $object))) {
        $object = 'noimage.jpg';

        return asset('/' . $object);
    } else {
        return asset('/storage/sections/' . $object);
    }
}

function blogImage($object)
{
    if (!File::exists(storage_path('app/public/blogs/' . $object))) {
        $object = 'noimage.jpg';

        return asset('/' . $object);
    } else {
        return asset('/storage/blogs/' . $object);
    }
}

function categoryImage($object)
{
    if (!File::exists(storage_path('app/public/categories/' . $object))) {
        $object = 'noimage.jpg';

        return asset('/' . $object);
    } else {
        return asset('/storage/categories/' . $object);
    }
}

function categoryImageThumb($object)
{
    if (!File::exists(storage_path('app/public/categories/thumb/' . $object))) {
        $object = 'noimage.jpg';

        return asset('/' . $object);
    } else {
        return asset('/storage/categories/thumb/' . $object);
    }
}

function signatureImage($object)
{
    if (!File::exists(storage_path('app/public/signatures/' . $object))) {
        $object = 'noimage.jpg';

        return asset('/' . $object);
    } else {
        return asset('/storage/signatures/' . $object);
    }
}

function trainingImage($object)
{
    if (!File::exists(storage_path('app/public/trainings/' . $object))) {
        $object = 'noimage.jpg';

        return asset('/' . $object);
    } else {
        return asset('/storage/trainings/' . $object);
    }
}

function trainingImageThumb($object)
{
    if (!File::exists(storage_path('app/public/trainings/thumb/' . $object))) {
        $object = 'noimage.jpg';

        return asset('/' . $object);
    } else {
        return asset('/storage/trainings/thumb/' . $object);
    }
}

function tokenExpired($updatedAt, $minute)
{
    return Carbon::parse($updatedAt)->addMinutes($minute)->isPast();
}
