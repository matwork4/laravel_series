<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Models\User;

class MenuController extends Controller
{
    public function index(){
        //Pour passer une variable dans la view
        //$user = User::find($user);

        return view('menu');
    }
}
