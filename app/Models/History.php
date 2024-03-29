<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class History extends Model
{
    use HasFactory;

    protected $with = ['group'];

    protected $guarded = [];

    public static function record($userId, $groupId, $text)
    {
        return static::create([
            'user_id' => $userId,
            'group_id' => $groupId,
            'text' => $text,
        ]);
    }

    public function getTextAttribute($text)
    {
        return Str::limit($text, 200);
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }

    public static function feed($user)
    {
        return static::where('user_id', $user->id)->latest()->limit(15)->get();
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
