<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ['languages'];

    public function scopeForUser($query, $user)
    {
        return $query->where('user_id', $user->id);
    }

    public function languages()
    {
        return $this->belongsToMany(Language::class);
    }
}
