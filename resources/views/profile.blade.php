

@extends('layouts/main')

@section('content')

@if($user->isAdmin)
    <h1>Profile Administrateur</h1>
@else
    <h1>Profile</h1>
@endif
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


@guest
@else
    @if(auth()->user()->isAdmin && !$user->isAdmin)
    <form action="/new_admin" enctype="multipart/form-data" method="post">
        @csrf
        <p>Ajouter {{ $user->name }} en tant qu'administrateur :</p>
        <input type='hidden' name='user_id' value='{{ $user->id }}' />
        <input class="btn btn-warning" type="submit" value="Ajouter Admin"/>
    </form>
    @endif

    @if(auth()->user()->isAdmin && $user->isAdmin)
    <form action="/remove_admin" enctype="multipart/form-data" method="post">
        @csrf
        <p>Retirer à {{ $user->name }} ses droits d'administrateur :</p>
        <input type='hidden' name='user_id' value='{{ $user->id }}' />
        <input class="btn btn-warning" type="submit" value="Retirer Admin"/>
    </form>
    @endif
@endguest
        
@endsection


