<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Serie;

class MenuController extends Controller
{
    public function index(){
        //Pour passer une variable dans la view
        //$user = User::find($user);
        $serie = Serie::all();

        return view('menu', [
            'serie' => $serie,
        ]);
    }
}
