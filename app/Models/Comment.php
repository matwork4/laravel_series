<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //Authorise la création de nouveaux commentaires
    protected $guarded = [];

    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function serie(){
        return $this->belongsTo(Serie::class);
    }
}
