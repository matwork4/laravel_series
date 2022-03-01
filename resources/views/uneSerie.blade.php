<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        

        @extends('layouts/main')

        @section('content')
        <h1>La série : {{ $serie->title }} </h1>
        
        <p>Résumé : {{ $serie->description }} </p>
        <p>Acteurs : {{ $serie->actors }} </p>

        <p>Auteur :  
            <button class="btn btn-primary"
            onclick="location.href='/profile/{{ $serie->user->id }}'">
                {{ $serie->user->username }}
            </button>
        </p>

        <p>Commentaires : 
            @foreach($serie->comment as $c)
                <br>
                <p>{{ $c->contenu }}</p>
                <p>Par {{ $c->user->username }}</p>
                <p>Le {{ $c->created_at }}</p>

                <!-- Supprimer un commentaire si il nous appartient -->
                @guest
                @else
                    @if($c->user_id == auth()->user()->id )
                    <form action="/c_remove" enctype="multipart/form-data" method="post">  
                        @csrf
                        <input type='hidden' name='serie_id' value='{{ $serie->id }}' />
                        <input type='hidden' name='comment_id' value='{{ $c->id }}' />
                        <input class="btn btn-primary" type="submit" value="Supprimer"/>
                    </form>
                    @endif
                @endguest

            @endforeach
        </p>
        
        @guest
            <p>Connectez vous pour ajouter un commentaire : 
                <button class="btn btn-primary"
                onclick="location.href='/login'">
                Se connecter</button></p>
            
        @else
            
            <form action="/c" enctype="multipart/form-data" method="post">
                @csrf
                <label for="commentaire">Ajouter un commentaire :</label><br>
                <input type="text" id="contenu" name="contenu" value=""><br><br>
                <!-- Permet de passer l'id de la série -->
                <input type='hidden' name='serie_id' value='{{ $serie->id }}' /> 
                <input class="btn btn-primary" type="submit" value="Poster"/>
            </form> 
        @endguest

        @endsection



    </body>
</html>
