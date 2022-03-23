
@extends('layouts/main')

@section('content')
<link rel="stylesheet" href="css/menu.css">

<div class="div_menu">
    
    <!--
    @guest
        <p>Bienvenue !</p>
        <p>Cliquez ici pour vous connecter : 
            <button class="btn btn-primary"
            onclick="location.href='/login'">
            Se connecter</button></p>
        <p>ou</p>
    @else
        <p>Vous êtes connecté ! </p>
        <p>Bienvenue {{ Auth::user()->username }}</p>
    @endguest

    <p>Cliquez ici pour accéder aux séries : 
        <button class="btn btn-primary"
        onclick="location.href='/series'">Voir
    </button></p>-->

    <div class="box">

        <!-- Affiche les images affiches des 8 premières séries. 
            Si il a moins de 8 séries, les répètes jusqu'à en obtenir 8.
            Si il n'y a pas de série, n'affiche pas d'image.
        -->
        <?php 
            $compte = 0; 
            $estVide = false; 
        ?>
        @while($compte<8 && $estVide == false)
            @foreach($serie as $s)
                @if($compte++ <= 8)
                <span style="--i:<?php echo $compte ?>"><img src="/storage/{{$s->image_miniature}}"></span>
                @endif
            @endforeach
            <?php
                //Si il n'y a aucune série on sort du while
                if($compte==0){
                    $estVide = true;
                    echo "Il n'y a encore aucune série !";
                }
            ?>
        @endwhile


        <!--
        <span style="--i:1;"><img src="assets/joker.png"></span>
        <span style="--i:2;"><img src="assets/joker.png"></span>
        <span style="--i:3;"><img src="assets/joker.png"></span>
        <span style="--i:4;"><img src="assets/joker.png"></span>
        <span style="--i:5;"><img src="assets/joker.png"></span>
        <span style="--i:6;"><img src="assets/joker.png"></span>
        <span style="--i:7;"><img src="assets/joker.png"></span>
        <span style="--i:8;"><img src="assets/joker.png"></span>-->


    </div>


    <h2>Bienvenue sur <span>Laravel</span> Series</h2>


</div>
@endsection
