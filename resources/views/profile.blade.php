

@extends('layouts/main')

@section('content')

<link rel="stylesheet" href="../css/profilePage.css">


<div id="contenu_profil">

  @if($user->isAdmin)
    <h1>Profile <span>Administrateur</span></h1>
  @else
    <h1>Profile</h1>
  @endif
  <p>Pseudo : {{ $user->username }}</p>
  <p>Nom : {{ $user->name }}</p>
  <p>Membre depuis le {{ $user->created_at->format('d-m-Y') }}</p>
  <!-- On affiche le titre des séries -->
  <p>Mes séries :</p>
  <div id="mes_series"> 
    @foreach($user->serie as $s)
        <div class="list" 
              onclick="location.href='/series/{{$s->id}}'"
              style="background: url('/storage/{{ $s->image_miniature }}') no-repeat center center /cover;
              --my-title-var: '{{ $s->title }}';"></div>


    @endforeach
  </div>

</div>


@guest
@else
  <div id="admin_div">
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
  </div>
@endguest
        
@endsection


