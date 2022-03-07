

@extends('layouts/main')

@section('content')
<h1>Profile</h1>
<p>Username : {{ $user->username }}</p>
<p>Nom : {{ $user->name }}</p>
<!-- On affiche le titre des séries -->
<p>Mes séries : 
    @foreach($user->serie as $s)
        <br>
        <button class="btn btn-primary"
        onclick="location.href='/series/{{$s->id}}'">
            {{$s->title}}
        </button>
    @endforeach
</p>
        
@endsection


