<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class TrainingMedia extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['name', 'path'];
    public const TYPE_DOCUMENT = 'document';
    public const TYPE_VIDEO = 'video';

    public const TYPE_ARRAY = [
        self::TYPE_DOCUMENT,
        self::TYPE_VIDEO,
    ];

    public const ALLOWED_EXTS = [
        'pdf',
        'mp4',
        'ppt',
        'pptx',
        'docx',
    ];

    public const DOCUMENT_EXT_ARR = [
        'pdf',
        'docx',
    ];

    public const VIDEO_EXT_ARR = [
        'mp4',
    ];
}
