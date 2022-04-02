
        

@extends('layouts/main')

@section('content')

<link rel="stylesheet" href="./css/contactPage.css">

<div id="formulaire_contact">

    <form action="/contact_store" enctype="multipart/form-data" method="post">
        @csrf
        <h2>Formulaire de contacts</h2><br>

        <p>Nom :</p><br>
        <input type="text" id="name" name="name" value=""><br>
        <p>Email :</p><br>
        <input type="text" id="email" name="email" value=""><br>
        <p>Message :</p><br>
        <input type="text" id="message" name="message" value=""><br>

      <input class="btn btn-primary" type="submit" value="Envoyer"/>
    </form> 

</div>

<br/>     

<div id="liste_admins">
    <p>Administrateurs du site : </p>
    @foreach($user as $u)
      @if($u->isAdmin)
        <button class="btn btn-primary" onclick="location.href='/profile/{{ $u->id }}'">
            {{ $u->username }}
        </button>
      @endif      
    @endforeach
</div>

@guest
@else
  <!-- La liste des messages vue par les admins -->
  <div id="champ_admin">

    @if(auth()->user()->isAdmin )
    <h2>Vous êtes administrateur</h2>
    <h3>Liste des messages : </h3>

    @foreach($contact as $c)
    <div class="message_contact">
        <p>Par {{ $c->name }} le {{ $c->created_at }}</p>
        <p>Email : {{ $c->email }}</p>
        <p>{{ $c->message }}</p>  
    </div>      
    @endforeach

    @endif
  </div>
@endguest





@endsection

