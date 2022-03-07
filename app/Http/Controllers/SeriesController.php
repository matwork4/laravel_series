<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Serie;

class SeriesController extends Controller
{
    public function index(){

        $serie = Serie::all();
        return view('series', [
            'serie' => $serie,
        ]);
    }

    public function number($serie){
        $serie = Serie::findOrFail($serie);
        return view('uneSerie', [
            'serie' => $serie,
        ]);
    }

    public function createSerie(){
        $serie = Serie::all();
        return view('createSerie', [
            'serie' => $serie,
        ]);
    }

    public function store(){
        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'actors' => 'required',
            'tags' => 'required',
            'url_video' => 'required',
            'image_miniature' => ['required','image'],
            'image_background' => 'image',
        ]);

        //dd(request()->all());
        $image_miniaturePath = "/storage/".request('image_miniature')->store('uploads','public');
        if(request('image_background')!=null){
            $image_backgroundPath = "/storage/".request('image_background')->store('uploads','public');
        }else{
            $image_backgroundPath = "/assets/background_cinema.png";
        }


        $serie = auth()->user()->serie()->create([
            'title' => $data['title'],
            'description' => $data['description'],
            'actors' => $data['actors'],
            'tags' => $data['tags'],
            'url_video' => $data['url_video'],
            'image_miniature' => $image_miniaturePath,
            'image_background' => $image_backgroundPath,
        ]);

        //On redirige vers la série nouvellement créée
        return redirect('/series/'.$serie->id);
    }

    public function remove(){
        $data = request()->validate([
            'serie_id' => 'required',
        ]);
        

        if(Serie::find($data['serie_id']) == true){
            $serie = Serie::find($data['serie_id']);

            //Il faut d'abord supprimer les commentaires qui lui sont liés
            foreach($serie->comment as $c){
                $c->delete();
            }
            //Puis ont peut supprimer la série
            $serie->delete();
        }
        //On redirige vers la page des séries 
        return redirect('/series');
    }

}

