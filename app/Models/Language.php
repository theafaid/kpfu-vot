<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Language extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeFetch($query)
    {
        return $query->get(['id', 'name_ru', 'name_en', 'name_native', 'slug', 'icon_path']);

//        cache()->forget('languages');
//        return Cache::rememberForever('languages', function () use ($query) {
//            return $query->get(['id', 'name_ru', 'name_en', 'name_native', 'slug', 'icon_path']);
//        });
    }
}
