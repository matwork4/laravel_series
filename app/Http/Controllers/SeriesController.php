<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Serie;
use Illuminate\Support\Facades\Storage;

class SeriesController extends Controller
{
    public function index(){

        $serie = Serie::all();
        return view('series', [
            'serie' => $serie,
        ]);
    }

    //Retourne la vue de la série en fonction de son ID
    public function number($serie){
        $serie = Serie::findOrFail($serie);
        return view('uneSerie', [
            'serie' => $serie,
        ]);
    }

    //Retourne la page avec le formulaire pour créer une série
    public function createSerie(){
        $serie = Serie::all();
        return view('createSerie', [
            'serie' => $serie,
        ]);
    }

    //Enregistre une nouvelle série
    public function store(){
        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'actors' => 'required',
            'tags' => 'required',
            'url_video' => 'required',
            'image_miniature' => ['required','image'],
            'image_background' => 'image',
            'image_logo' => 'image',
        ]);

        //dd(request()->all());
        $image_miniaturePath = request('image_miniature')->store('uploads','public');

        //On ajoute les images par défault qui ne sont pas requises 
        if(request('image_background')!=null){
            $image_backgroundPath = request('image_background')->store('uploads','public');
        }else{
            $image_backgroundPath = "default";
        }

        if(request('image_logo')!=null){
            $image_logo = request('image_logo')->store('uploads','public');
        }else{
            $image_logo = "default";
        }


        $serie = auth()->user()->serie()->create([
            'title' => $data['title'],
            'description' => $data['description'],
            'actors' => $data['actors'],
            'tags' => $data['tags'],
            'url_video' => $data['url_video'],
            'image_miniature' => $image_miniaturePath,
            'image_background' => $image_backgroundPath,
            'image_logo' => $image_logo,
        ]);

        //On redirige vers la série nouvellement créée
        return redirect('/series/'.$serie->id);
    }

    //Supprime une série
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

            //On supprime les images de la série
            Storage::disk('public')->delete($serie->image_miniature);
            if($serie->image_background != "default"){
                Storage::disk('public')->delete($serie->image_background);
            }

            //Puis ont peut supprimer la série
            $serie->delete();

        }
        //On redirige vers la page des séries 
        return redirect('/series');
    }

    //Retourne une page pour modifier une série
    public function updateSerie($serie){
        $serie = Serie::findOrFail($serie);
        return view('updateSerie', [
            'serie' => $serie,
        ]);
    }

    //Commande pour modifier la série
    public function update(){
        //D'abord on valide la requète
        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'actors' => 'required',
            'tags' => 'required',
            'url_video' => 'required',
            'image_miniature' => 'image',
            'image_background' => 'image',
            'image_logo' => 'image',
            'serie_id' => 'required',
        ]);

        //Ensuite on cherche la série dans la base grâce à son id
        $serie=Serie::find($data['serie_id']);

        //On modifie les nouveaux paramètres 
        $serie->title = $data['title'];
        $serie->description = $data['description'];
        $serie->actors = $data['actors'];
        $serie->tags = $data['tags'];
        $serie->url_video = $data['url_video'];

        //Si on a uploader une nouvelle image
        if(request('image_miniature')!=null){
            //Si il y a déjà une image associée à la série
            if($serie->image_miniature != "default"){
                //On supprime cette ancienne image
                Storage::disk('public')->delete($serie->image_miniature);
            }
            //On ajoute la nouvelle image
            $serie->image_miniature = request('image_miniature')->store('uploads','public');
        }

        if(request('image_background')!=null){
            if($serie->image_background != "default"){
                Storage::disk('public')->delete($serie->image_background);
            }
            $serie->image_background = request('image_background')->store('uploads','public');
        }

        if(request('image_logo')!=null){
            if($serie->image_logo != "default"){
                Storage::disk('public')->delete($serie->image_logo);
            }
            $serie->image_logo = request('image_logo')->store('uploads','public');
        }

        //On save les nouvelles données
        $serie->save();

        //On redirige vers la vue de la série
        return redirect('/series/'.$serie->id);
    }
}

