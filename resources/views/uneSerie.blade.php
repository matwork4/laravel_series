
        

@extends('layouts/main')

@section('content')
<link rel="stylesheet" href="../css/moviePage.css">


<h1>La série : {{ $serie->title }} </h1>
        
<p>Résumé : {{ $serie->description }} </p>
<p>Acteurs : {{ $serie->actors }} </p>
<p>Tags : {{ $serie->tags }} </p>
<p>Bande annonce : {{ $serie->url_video }} </p>

<div>
    <img src="/storage/{{ $serie->image_miniature }}" style="width: 300px; height: 400px; object-fit: cover;">

    @if( $serie->image_background == 'default')
        <img src="/assets/default_background.png" style="width: 300px; height: 400px; object-fit: cover;">
    @else
        <img src="/storage/{{ $serie->image_background }}" style="width: 300px; height: 400px; object-fit: cover;">
    @endif

    @if( $serie->image_logo == 'default')
        <img src="/assets/default_logo.png" style="width: 200px; height: 100px; object-fit: cover;">
    @else
        <img src="/storage/{{ $serie->image_logo }}" style="width: 200px; height: 100px; object-fit: cover;">
    @endif

    
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
    @if($serie->user_id == auth()->user()->id || auth()->user()->isAdmin)
    <button class="btn btn-primary"
    onclick="location.href='/update/series/{{ $serie->id }}'">
        Modifier la série
    </button>

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
        <div class="commentaire">
        <!-- Supprimer/modifier un commentaire si il nous appartient -->
        @guest
        <p>Par {{ $c->user->username }} le {{ $c->created_at }}</p>
        <p>{{ $c->contenu }}</p>

        @else
            @if($c->user_id == auth()->user()->id || auth()->user()->isAdmin)

            <p>Par {{ $c->user->username }} le {{ $c->created_at }}</p>
            <!-- idée : Utiliser le hidden -->
            <!-- Pour modifier un commentaire -->
            <form action="/c_update" enctype="multipart/form-data" method="post">  
                @csrf
                <input type='text' name='contenu' value='{{ $c->contenu }}' ><br>
                <input type='hidden' name='comment_id' value='{{ $c->id }}' />
                <input class="btn btn-primary" type="submit" value="Modifier"/>
            </form>
            
            <!-- Pour supprimer un commentaire -->
            <form action="/c_remove" enctype="multipart/form-data" method="post">  
                @csrf
                <input type='hidden' name='serie_id' value='{{ $serie->id }}' />
                <input type='hidden' name='comment_id' value='{{ $c->id }}' />
                <input class="btn btn-danger" type="submit" value="Supprimer"/>
            </form>
            @else
            <p>Par {{ $c->user->username }} le {{ $c->created_at }}</p>
            <p>{{ $c->contenu }}</p>
            
            @endif
        @endguest
        </div>

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


