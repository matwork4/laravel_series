<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ContactController extends Controller
{
    public function index(){

        //On récupère les utilisateurs
        $user = User::all();
        return view('contact', [
            'user' => $user,
        ]);
    }
}

