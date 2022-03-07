

@extends('layouts/main')

@section('content')
<h1>Series</h1>
<div><img src="/assets/icon_camera.png" alt=""></div>

<p>Liste des {{$serie->count()}} séries :
    @foreach($serie as $s)
        <br>
        <button class="btn btn-primary"
        onclick="location.href='/series/{{$s->id}}'">
            {{$s->title}}
        </button>
        
        {{$s->description}}
    @endforeach
</p>

<button class="btn btn-primary"
onclick="location.href='/create/serie'">
Ajouter une série</button>



@endsection

