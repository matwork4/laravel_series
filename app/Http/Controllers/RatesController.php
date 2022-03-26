<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Serie;
use App\Models\Comment;
use App\Models\Rate;

class RatesController extends Controller
{
    public function __construct(){
        //oblige a etre connecté pour utiliser les méthodes de la classe
        $this->middleware('auth');
    }

    public function store(){
        $data = request()->validate([
            'value' => 'required',
            'serie_id' => 'required',
        ]);

        //On récupère l'id de l'user connecté
        $user_id = auth()->user()->id;

        //Si on est pas connecté, on redirige vers la même page de série
        if($user_id==null){
            return redirect('/series/'.$data['serie_id']);
        }

        //On vérifie si l'utilisateur a déjà voté 
        $rate = \DB::table('rates')->where('user_id','=',$user_id)->where('serie_id','=',$data['serie_id'])->get();
        
        if(count($rate)==0){
            //On créer une nouvelle note
            auth()->user()->rate()->create($data);

        }else{
            //Pour changer la note actuelle :
            //On récupère le Rate en fonction de l'id
            $nr = Rate::findOrFail($rate[0]->id);
            //On change sa valeur
            $nr->value=$data['value'];
            //On l'enregistre
            $nr->save();
            $nr->push();
        }

        //On compte le nombre de notes pour cette série
        $count = Rate::where('serie_id','=',$data['serie_id'])->count();

        //On récupère la série en fonction de son id
        $serie = Serie::findOrFail($data['serie_id']);

        //On update la note de la série avec la nouvelle note
        if($serie->note == null){
            //Si il n'y a pas encore de note
            $serie->note = $data['value'];
        }else{
            $notes = 0;
            foreach(Rate::all() as $r){
                if($r->serie_id == $data['serie_id']){
                    $notes = $notes + $r->value;
                }
            }
            $serie->note = $notes/$count;

        }

        //On enregristre les modifications de la série
        $serie->save();
        $serie->push();

        //On retourne sur la page de la série
        return redirect('/series/'.$data['serie_id']);
    }


}
