<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfilesController extends Controller
{
    public function index($user){

        $user = User::findOrFail($user);
        return view('profile', [
            'user' => $user,
        ]);
    }

    public function newAdmin(){
        $data = request()->validate([
            'user_id' => 'required',
        ]);

        $user = User::findOrFail($data['user_id']);

        $user->isAdmin = true;
        $user->save();

        return redirect('/profile/'.$data['user_id']);
    }

    public function removeAdmin(){
        $data = request()->validate([
            'user_id' => 'required',
        ]);

        $user = User::findOrFail($data['user_id']);

        $user->isAdmin = false;
        $user->save();

        return redirect('/profile/'.$data['user_id']);

    }
}
