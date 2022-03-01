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

        <p> Cliquez ici pour accéder aux séries : 
            <button class="btn btn-primary"
            onclick="location.href='/series'">Voir
        </button></p>



        @endsection

    </body>
</html>
