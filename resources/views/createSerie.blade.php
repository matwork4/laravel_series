@extends('layouts/main')

@section('content')
<link rel="stylesheet" href="../css/crudSerie.css">


@guest
    <p>Connectez vous pour ajouter une série : 
        <button class="btn btn-primary"
        onclick="location.href='/login'">
        Se connecter</button></p>
            
@else
  <div id="form">
    <form action="/s_store" enctype="multipart/form-data" method="post">
        @csrf
        <h3>Ajouter une série</h3><br>
        <p>Titre :</p><br>
        <input type="text" id="title" name="title" value=""><br>
        <p>Description :</p><br>
        <input type="text" id="description" name="description" value=""><br>
        <p>Acteurs :</p><br>
        <input type="text" id="actors" name="actors" value=""><br>
        <p>Tags :</p><br>
        <input type="text" id="tags" name="tags" value=""><br>
        <p>URL de la bande annonce :</p><br>
        <input type="text" id="url_video" name="url_video" value=""><br>

        <p>Image de l'affiche du film : (Requis) </p>
        <input type="file" class="form-control-file" id="image_miniature" name="image_miniature"><br>
        @if ($errors->has('image_miniature'))
            <strong>{{ $errors->first('image_miniature') }}</strong>
        @endif

        <p>Image de fond d'écran : (Facultatif) </p>
        <input type="file" class="form-control-file" id="image_background" name="image_background"><br>

        <p>Image de l'icone du film : (Facultatif) </p>
        <input type="file" class="form-control-file" id="image_logo" name="image_logo"><br>
        

        <input class="btn btn-primary" type="submit" value="Créer"/>
    </form> 
  </div>
@endguest


@endsection
