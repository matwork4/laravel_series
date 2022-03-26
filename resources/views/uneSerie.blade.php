
        

@extends('layouts/main')

@section('content')
<link rel="stylesheet" href="../css/moviePage.css">
<link rel="stylesheet" href="../css/rating.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>

<!-- Si aucune image n'a été uploadée, on met une image par défault -->
@if($serie->image_logo == 'default')
<style>
body{
    background: url('/assets/default_background.png');
    background-size: contain;
}
</style>
@else
<style>
body{
    background: url('/storage/{{ $serie->image_background }}');
    background-size: contain;
}
</style>
@endif

<style>
.slide{
    background: url('/storage/{{ $serie->image_miniature }}');
    background-size: cover;
}

</style>

<header>
    <a href="#" class="logo">
      @if($serie->image_logo == 'default')
        <img src="/assets/default_logo.png" style="filter: invert(100%);">
      @else
        <img src="/storage/{{ $serie->image_logo }}">
      @endif
    </a>
</header>


<div class="banner">

    <!-- Affiche la note de la série sous forme d'étoiles -->
    <div class="rating">
      @if($serie->note >= 4.5)
        <input type="radio" name="star" id="star5" type="submit" checked>
        <label for="star5"></label>
        <input type="radio" name="star" id="star4" type="submit">
        <label for="star4"></label>
        <input type="radio" name="star" id="star3" type="submit">
        <label for="star3"></label>
        <input type="radio" name="star" id="star2" type="submit">
        <label for="star2"></label>
        <input type="radio" name="star" id="star1" type="submit">
        <label for="star1"></label>

      @elseif($serie->note >= 3.5)
        <input type="radio" name="star" id="star5" type="submit">
        <label for="star5"></label>
        <input type="radio" name="star" id="star4" type="submit" checked>
        <label for="star4"></label>
        <input type="radio" name="star" id="star3" type="submit">
        <label for="star3"></label>
        <input type="radio" name="star" id="star2" type="submit">
        <label for="star2"></label>
        <input type="radio" name="star" id="star1" type="submit">
        <label for="star1"></label>
        
      @elseif($serie->note >= 2.5)
        <input type="radio" name="star" id="star5" type="submit">
        <label for="star5"></label>
        <input type="radio" name="star" id="star4" type="submit">
        <label for="star4"></label>
        <input type="radio" name="star" id="star3" type="submit" checked>
        <label for="star3"></label>
        <input type="radio" name="star" id="star2" type="submit">
        <label for="star2"></label>
        <input type="radio" name="star" id="star1" type="submit">
        <label for="star1"></label>
        
      @elseif($serie->note >= 1.5)
        <input type="radio" name="star" id="star5" type="submit">
        <label for="star5"></label>
        <input type="radio" name="star" id="star4" type="submit">
        <label for="star4"></label>
        <input type="radio" name="star" id="star3" type="submit">
        <label for="star3"></label>
        <input type="radio" name="star" id="star2" type="submit" checked>
        <label for="star2"></label>
        <input type="radio" name="star" id="star1" type="submit">
        <label for="star1"></label>
        
      @elseif($serie->note >= 0.5)
        
        <input type="radio" name="star" id="star5" type="submit">
        <label for="star5"></label>
        <input type="radio" name="star" id="star4" type="submit">
        <label for="star4"></label>
        <input type="radio" name="star" id="star3" type="submit">
        <label for="star3"></label>
        <input type="radio" name="star" id="star2" type="submit">
        <label for="star2"></label>
        <input type="radio" name="star" id="star1" type="submit" checked>
        <label for="star1"></label>

      @else
        <input type="radio" name="star" id="star5" type="submit">
        <label for="star5"></label>
        <input type="radio" name="star" id="star4" type="submit">
        <label for="star4"></label>
        <input type="radio" name="star" id="star3" type="submit">
        <label for="star3"></label>
        <input type="radio" name="star" id="star2" type="submit">
        <label for="star2"></label>
        <input type="radio" name="star" id="star1" type="submit">
        <label for="star1"></label>
      @endif
    </div>
    <div id="nb_votes">
      @if($serie->rate->count() > 0)
        <p>{{ $serie->note }}/5 ({{ $serie->rate->count() }} votes)</p>
      @else
        <p>Aucun vote</p>
      @endif
    </div>

    <!-- Boutons pour attribuer une note aux séries -->
    <div class="rating_btn">

        <form action="/rate_store" enctype="multipart/form-data" method="post">  
            @csrf
            <input type='hidden' name='serie_id' value='{{ $serie->id }}' />
            <input type='hidden' name='value' value='5' />
            <button type="submit"></button>
        </form>

        <form action="/rate_store" enctype="multipart/form-data" method="post">  
            @csrf
            <input type='hidden' name='serie_id' value='{{ $serie->id }}' />
            <input type='hidden' name='value' value='4' />
            <button type="submit"></button>
        </form>

        <form action="/rate_store" enctype="multipart/form-data" method="post">  
            @csrf
            <input type='hidden' name='serie_id' value='{{ $serie->id }}' />
            <input type='hidden' name='value' value='3' />
            <button type="submit"></button>
        </form>

        <form action="/rate_store" enctype="multipart/form-data" method="post">  
            @csrf
            <input type='hidden' name='serie_id' value='{{ $serie->id }}' />
            <input type='hidden' name='value' value='2' />
            <button type="submit"></button>
        </form>

        <form action="/rate_store" enctype="multipart/form-data" method="post">  
            @csrf
            <input type='hidden' name='serie_id' value='{{ $serie->id }}' />
            <input type='hidden' name='value' value='1' />
            <button type="submit"></button>
        </form>
    </div>



    <!-- Content section -->
    <div class="content">
        <h2>{{ $serie->title }}</h2>
        <p>{{ $serie->description }}</p>
        <p>Avec {{ $serie->actors }} </p>
        <p>Série postée par   
            <button class="btn btn-primary"
            onclick="location.href='/profile/{{ $serie->user->id }}'">
                {{ $serie->user->username }}
            </button>
        </p>
        <a href="#" class="play" onclick="toggle();"><img src="../assets/moviePage/play.png">Voir trailer</a>
        
        <div class="slide"></div>
        <ul class="sci">
            <li><a href="#"><img src="/assets/moviePage/facebook.png"></a></li>
            <li><a href="#"><img src="/assets/moviePage/twitter.png"></a></li>
            <li><a href="#"><img src="/assets/moviePage/instagram.png"></a></li>
        </ul>

        <!-- Modifier/supprimer la série si elle nous appartient -->
        @guest
        @else
            @if($serie->user_id == auth()->user()->id || auth()->user()->isAdmin)
            <div id="serie_controles">
            <button class="btn btn-primary"
            onclick="location.href='/update/series/{{ $serie->id }}'">
                Modifier la série
            </button>

            <form action="/s_remove" enctype="multipart/form-data" method="post">  
                @csrf
                <input type='hidden' name='serie_id' value='{{ $serie->id }}' />
                <input class="btn btn-danger" type="submit" value="Supprimer la série"/>
            </form>
            </div>
            @endif
        @endguest
    </div>
</div>

<div class="trailer">
    <!-- Script pour visionner des videos youtube -->
    <video data-yt2html5="{{ $serie->url_video }}" controls="true"></video>
    <script src="https://cdn.jsdelivr.net/gh/thelevicole/youtube-to-html5-loader@4.0.1/dist/YouTubeToHtml5.js"></script>
    <script>new YouTubeToHtml5();</script>
            
    <img src="/assets/moviePage/close.png" class="close" onclick="toggle();"/>
</div>

<script type="text/javascript">
    function toggle(){
        var trailer = document.querySelector('.trailer');
        var video = document.querySelector('video');
        trailer.classList.toggle('active');
        video.currentTime = 0;
        video.pause();
    }
</script>

<!-- Commentaires -->
<div id="liste_commentaires">
    <p>{{ $serie->comment->count() }} Commentaires (récents d'abord) : </p>
    @foreach($serie->comment as $c)
        <br>
        <div class="commentaire">
        <!-- Supprimer/modifier un commentaire si il nous appartient -->
        @guest
        <p>Par {{ $c->user->username }} le {{ $c->created_at }}</p>
        <p id="contenu">{{ $c->contenu }}</p>

        @else
            @if($c->user_id == auth()->user()->id || auth()->user()->isAdmin)
            
            <p>Par {{ $c->user->username }} le {{ $c->created_at }}</p>
            <!-- idée : Utiliser le hidden -->
            <!-- Pour modifier un commentaire -->
            <div id="boutons_commentaires">
            <form action="/c_update" enctype="multipart/form-data" method="post">  
                @csrf
                <div id="id_com">
                    <input type='text' name='contenu' value='{{ $c->contenu }}'><br>
                </div>
                <input type='hidden' name='comment_id' value='{{ $c->id }}' />
                <input id="btn_modifier" class="btn btn-primary" type="submit" value="Modifier"/>
            </form>
            
            <!-- Pour supprimer un commentaire -->
            <form action="/c_remove" enctype="multipart/form-data" method="post">  
                @csrf
                <input type='hidden' name='serie_id' value='{{ $serie->id }}' />
                <input type='hidden' name='comment_id' value='{{ $c->id }}' />
                <input id="btn_supprimer" class="btn btn-danger" type="submit" value="Supprimer"/>
            </form>
            </div>
            @else
            <p>Par {{ $c->user->username }} le {{ $c->created_at }}</p>
            <p id="contenu">{{ $c->contenu }}</p>
            
            @endif
        @endguest
        </div>

    @endforeach

        
    <div id="nouveau_commentaire">
    @guest
        <p>Connectez vous pour ajouter un commentaire : 
            <button class="btn btn-primary"
            onclick="location.href='/login'">
            Se connecter</button></p>
            
    @else
        <p>Ecrire un nouveau commentaire :</p> 
        <form action="/c_store" enctype="multipart/form-data" method="post">
            @csrf
            <input type="text" id="contenu" name="contenu" value=""><br><br>
            <!-- Permet de passer l'id de la série -->
            <input type='hidden' name='serie_id' value='{{ $serie->id }}' /> 
            <input id="btn_poster" class="btn btn-primary" type="submit" value="Poster"/>
        </form> 
    @endguest
    </div>

</div>


@endsection


