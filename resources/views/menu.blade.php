
@extends('layouts/main')

@section('content')
<div class="div_menu">
    <h1>Main Menu</h1>

    @guest
        <p>Bienvenue !</p>
        <p>Cliquez ici pour vous connecter : 
            <button class="btn btn-primary"
            onclick="location.href='/login'">
            Se connecter</button></p>
        <p>ou</p>
    @else
        <p>Bienvenue {{ Auth::user()->username }}</p>
    @endguest

    <p>Cliquez ici pour accéder aux séries : 
        <button class="btn btn-primary"
        onclick="location.href='/series'">Voir
    </button></p>


</div>
@endsection
