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
        <h1>Series</h1>
        <div><img src="/assets/icon_camera.png" alt=""></div>

        <p>Liste des séries :
            @foreach($serie as $s)
                <br>
                <button class="btn btn-primary"
                onclick="location.href='/series/{{$s->id}}'">
                    {{$s->title}}
                </button>
                
                {{$s->description}}
            @endforeach
        </p>


        @endsection



    </body>
</html>
