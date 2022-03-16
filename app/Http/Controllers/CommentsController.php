<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Serie;
use App\Models\Comment;

class CommentsController extends Controller
{
    public function __construct(){
        //oblige a etre connecté pour utiliser les méthodes de la classe
        $this->middleware('auth');
    }
    
    public function store(){
        $data = request()->validate([
            'contenu' => 'required',
            'serie_id' => 'required',
        ]);

        //On récupère la série en fonction de son id
        $serie = Serie::findOrFail($data['serie_id']);

        /* On vérifie que le commentaire n'a pas été dupliqué
        * pour éviter que lorsqu'on actualise la page le commentaire
        * soit posté à nouveau.
        * Avec ça on ne peut pas poster 2 fois le même commentaire.
        */
        $doublon = false;
        foreach($serie->comment as $c){
            if($c->contenu == $data['contenu']){
                $doublon = true;
            }
        }

        //Permet de récupérer l'id de l'utilisateur
        if($doublon == false){
            auth()->user()->comment()->create($data);

            /* On actualise la série si elle a été modifiée
            * avant de la passer à la view.
            */ 
            $serie = Serie::findOrFail($data['serie_id']);
        }

        //On revoie vers la même page de série
        /*
        return view('uneSerie', [
            'serie' => $serie,
        ]);*/

        //On redirige vers la même page de série
        return redirect('/series/'.$data['serie_id']);
    }

    public function remove(){
        $data = request()->validate([
            'serie_id' => 'required',
            'comment_id' => 'required',
        ]);
        

        if(Comment::find($data['comment_id']) == true){
            Comment::find($data['comment_id'])->delete();
        }
        $serie = Serie::findOrFail($data['serie_id']);

        //On revoie vers la même page de série
        /*
        return view('uneSerie', [
            'serie' => $serie,
        ]);*/

        //On redirige vers la même page de série
        return redirect('/series/'.$data['serie_id']);

        //Possitilité d'utiliser Ajax pour la redirection (et plus joli)

    }

    public function update(){
        $data = request()->validate([
            'comment_id' => 'required',
            'contenu' => 'required',
        ]);

        $comment=Comment::find($data['comment_id']);

        $comment->contenu = $data['contenu'];
        $comment->save();


        return redirect('/series/'.$comment->serie_id);
    }
}
