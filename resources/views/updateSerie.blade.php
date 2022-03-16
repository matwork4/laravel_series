
        

@extends('layouts/main')

@section('content')

<!-- Modifier la série uniquement si elle nous appartient -->
@guest
<p>Vous devez être connecté pour accéder à cette page</p>
@else
    @if($serie->user_id == auth()->user()->id || auth()->user()->isAdmin)

    <form action="/s_update" enctype="multipart/form-data" method="post">
    @csrf

        <h1>Modifier la série : {{ $serie->title }} </h1>
        
        <p>Titre :</p><br>
        <input type="text" id="title" name="title" value="{{ $serie->title }}"><br>
        <p>Description :</p><br>
        <input type="text" id="description" name="description" value="{{ $serie->description }}"><br>
        <p>Acteurs :</p><br>
        <input type="text" id="actors" name="actors" value="{{ $serie->actors }}"><br>
        <p>Tags :</p><br>
        <input type="text" id="tags" name="tags" value="{{ $serie->tags }}"><br>
        <p>URL de la bande annonce :</p><br>
        <input type="text" id="url_video" name="url_video" value="{{ $serie->url_video }}"><br>

        <div>
            <p>Image de l'affiche du film : </p>
                <input type="file" class="form-control-file" id="image_miniature" name="image_miniature"><br>
            <img src="/storage/{{ $serie->image_miniature }}" style="width: 300px; height: 400px; object-fit: cover;">

            <p>Image de fond d'écran : </p>
                <input type="file" class="form-control-file" id="image_background" name="image_background"><br>
            @if( $serie->image_background == 'default')
                <img src="/assets/default_background.png" style="width: 300px; height: 400px; object-fit: cover;">
            @else
                <img src="/storage/{{ $serie->image_background }}" style="width: 300px; height: 400px; object-fit: cover;">
            @endif

            <p>Image de l'icone du film : </p>
                <input type="file" class="form-control-file" id="image_logo" name="image_logo"><br>
            @if( $serie->image_logo == 'default')
                <img src="/assets/default_logo.png" style="width: 200px; height: 100px; object-fit: cover;">
            @else
                <img src="/storage/{{ $serie->image_logo }}" style="width: 200px; height: 100px; object-fit: cover;">
            @endif
        </div>

        <input type='hidden' name='serie_id' value='{{ $serie->id }}' />

        <input class="btn btn-success" type="submit" value="Confirmer"/>
        <input class="btn btn-warning" type="button" value="Annuler"
        onclick="location.href='/series/{{$serie->id}}'"/>
    </form>

    @else
        <p>Vous devez posséder la série {{ $serie->title }} pour accéder à cette page </p>
    @endif
    
@endguest


@endsection


