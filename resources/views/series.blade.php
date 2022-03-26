

@extends('layouts/main')

@section('content')
<link rel="stylesheet" href="css/series.css">


<div class="trending">
    <h1>Films et Séries <span>Voir tout</span></h1>

    <div class="search-bar">
        <input type="text" placeholder="Chercher acteurs, tags..." class="search">
        <a href="#"><i class="material-icons md-36">search</i></a>
    </div>

    <!-- Affiche les 8 premiers films au dessus -->
    <div class="movie-container">
      <?php 
        $i=0; 
        $nb_par_ligne=8;
      ?>
      @foreach($serie as $s)
        @if($i<$nb_par_ligne)
            <div class="list" 
            onclick="location.href='/series/{{$s->id}}'"
            style="background: url('/storage/{{ $s->image_miniature }}') no-repeat center center /cover;
            --my-title-var: '{{ $s->title }}';"></div>
        @endif
        <?php $i=$i+1; ?>
      @endforeach
    </div>

    <!-- Puis les 8 suivants au dessus -->
    <div class="movie-container">
      <?php $i=0; ?>
      @foreach($serie as $s)
        @if($i>=$nb_par_ligne)
            <div class="list" 
            onclick="location.href='/series/{{$s->id}}'"
            style="background: url('/storage/{{ $s->image_miniature }}') no-repeat center center /cover;
            --my-title-var: '{{ $s->title }}';"></div>
        @endif
        <?php $i=$i+1; ?>
      @endforeach
    </div>

</div>



<!--
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
-->


@endsection

