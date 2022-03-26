<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{  
    //Authorise la création de nouvelles notes
    protected $guarded = [];
    use HasFactory;
    
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function serie(){
        return $this->belongsTo(Serie::class);
    }
}
