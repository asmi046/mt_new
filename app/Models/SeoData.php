<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoData extends Model
{
    use HasFactory;

    public $fillable = [
        'url',
        'img',
        'seo_title',
        'seo_description',
        'page_title',
    ];
}
