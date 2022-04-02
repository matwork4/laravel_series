

@extends('layouts/main')

@section('content')
<link rel="stylesheet" href="css/series.css">


<div class="trending">
    <h1>Films et Séries <a href="/series" style="text-decoration: none;"><span>Voir tout</span></a></h1>

    <form action="/series_search" enctype="multipart/form-data" method="post">
      @csrf
      <div class="search-bar">
        <!-- Si il y a des tags, on les affiches dans la bar -->
        @if(isset($tags)) 
          <input type="text" id="tags" name="tags"
          placeholder="{{ $tags }}" class="search">
        @else
          <input type="text" id="tags" name="tags"
          placeholder="Chercher titre, acteurs, tags" class="search">
        @endif
        
        <label class="material-icons md-36">
            <span class="material-icons md-36" id="my-label-id">search</span>
            <input type="submit" aria-labelledby="my-label-id" id="input_search"/>
        </label>
      </div>
    </form>


    <!-- Affiche les 8 premiers films au dessus -->
    <div class="movie-container">
      <!-- La variable nb_par_ligne permet d'afficher n films 
        par ligne maximum -->
      <?php 
        $i=0; 
        $nb_par_ligne=8;
      ?>
      @foreach($serie as $s)
        @if($i<$nb_par_ligne)
        <!-- Si il y a des tags -->
          @if(isset($tags)) 
          <!-- On cherche les mots clefs dans le titre, les acteurs ou les tags 
            On passe en majuscules les tags -->
            @if(str_contains(strtoupper($s->tags),strtoupper($tags)) || str_contains(strtoupper($s->actors),strtoupper($tags)) || str_contains(strtoupper($s->title),strtoupper($tags)))
              <div class="list" 
              onclick="location.href='/series/{{$s->id}}'"
              style="background: url('/storage/{{ $s->image_miniature }}') no-repeat center center /cover;
              --my-title-var: '{{ $s->title }}';"></div>
            @endif
        <!-- Sinon on affiche toutes les séries -->
          @else
            <div class="list" 
              onclick="location.href='/series/{{$s->id}}'"
              style="background: url('/storage/{{ $s->image_miniature }}') no-repeat center center /cover;
              --my-title-var: '{{ $s->title }}';"></div>
          @endif
        @endif
        <?php $i=$i+1; ?>
      @endforeach
    </div>

    <!-- Puis les 8 suivants au dessus -->
    <div class="movie-container">
      <?php 
        $i=0; 
      ?>
      @foreach($serie as $s)
        @if($i>=$nb_par_ligne)
        <!-- Si il y a des tags -->
          @if(isset($tags)) 
          <!-- On cherche les mots clefs dans le titre, les acteurs ou les tags -->
            @if(str_contains(strtoupper($s->tags),strtoupper($tags)) || str_contains(strtoupper($s->actors),strtoupper($tags)) || str_contains(strtoupper($s->title),strtoupper($tags)))
              <div class="list" 
              onclick="location.href='/series/{{$s->id}}'"
              style="background: url('/storage/{{ $s->image_miniature }}') no-repeat center center /cover;
              --my-title-var: '{{ $s->title }}';"></div>
            @endif
        <!-- Sinon on affiche toutes les séries -->
          @else
            <div class="list" 
              onclick="location.href='/series/{{$s->id}}'"
              style="background: url('/storage/{{ $s->image_miniature }}') no-repeat center center /cover;
              --my-title-var: '{{ $s->title }}';"></div>
          @endif
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

