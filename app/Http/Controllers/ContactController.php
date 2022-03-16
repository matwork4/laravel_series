<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index(){

        //On récupère les utilisateurs
        $user = User::all();
        $contact = Contact::all();
        return view('contact', [
            'user' => $user,
            'contact' => $contact,
        ]);
    }

    public function store(){
        $data = request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'message' => 'required',
        ]);
        
        contact::create($data);

        return redirect('/contact');
    }
}

