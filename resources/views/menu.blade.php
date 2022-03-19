
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
        <span style="--i:1;"><img src="assets/joker.png"></span>
        <span style="--i:2;"><img src="assets/joker.png"></span>
        <span style="--i:3;"><img src="assets/joker.png"></span>
        <span style="--i:4;"><img src="assets/joker.png"></span>
        <span style="--i:5;"><img src="assets/joker.png"></span>
        <span style="--i:6;"><img src="assets/joker.png"></span>
        <span style="--i:7;"><img src="assets/joker.png"></span>
        <span style="--i:8;"><img src="assets/joker.png"></span>
    </div>


    <h2>Bienvenue sur <span>Laravel</span> Series</h2>


</div>
@endsection
