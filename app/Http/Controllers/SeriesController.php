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

    /*
    public function createComment($serie){
        $serie = Serie::findOrFail($serie);
        return view('uneSerie', [
            'serie' => $serie,
        ]);
    }*/
}

