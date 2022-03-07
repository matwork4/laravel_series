
        

@extends('layouts/main')

@section('content')
<h1>La série : {{ $serie->title }} </h1>
        
<p>Résumé : {{ $serie->description }} </p>
<p>Acteurs : {{ $serie->actors }} </p>
<p>Tags : {{ $serie->tags }} </p>
<p>Bande annonce : {{ $serie->url_video }} </p>

<div>
    <img src="{{ $serie->image_miniature }}" style="width: 300px; height: 400px; object-fit: cover;">

    <img src="{{ $serie->image_background }}" style="width: 600px; height: 300px; object-fit: cover;">
</div>

<p>Auteur :  
    <button class="btn btn-primary"
    onclick="location.href='/profile/{{ $serie->user->id }}'">
        {{ $serie->user->username }}
    </button>
</p>

<!-- Supprimer une série si il nous appartient -->
@guest
@else
    @if($serie->user_id == auth()->user()->id )
    <form action="/s_remove" enctype="multipart/form-data" method="post">  
        @csrf
        <input type='hidden' name='serie_id' value='{{ $serie->id }}' />
        <input class="btn btn-danger" type="submit" value="Supprimer la série"/>
    </form>
    @endif
@endguest


<p>{{ $serie->comment->count() }} Commentaires (récents d'abord) : 
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
            
    <form action="/c_store" enctype="multipart/form-data" method="post">
        @csrf
        <label for="commentaire">Ajouter un commentaire :</label><br>
        <input type="text" id="contenu" name="contenu" value=""><br><br>
        <!-- Permet de passer l'id de la série -->
        <input type='hidden' name='serie_id' value='{{ $serie->id }}' /> 
        <input class="btn btn-primary" type="submit" value="Poster"/>
    </form> 
@endguest

@endsection


