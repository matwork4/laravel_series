<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function comment(){
        return $this->hasMany(Comment::class)->orderBy('created_at','DESC');
    }

    public function rate(){
        return $this->hasMany(Rate::class)->orderBy('created_at','DESC');
    }
}
