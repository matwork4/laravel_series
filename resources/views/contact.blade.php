
        

@extends('layouts/main')

@section('content')
<h1>Contacts</h1>
        
<p>Liste des administrateurs à contacter :  
    @foreach($user as $u)
        <br>
        <p>{{ $u->username }}</p>
        <button class="btn btn-primary"
        onclick="location.href='#'">
            Contacter
        </button>
    @endforeach
</p>


@endsection

