<!doctype html>
<html class="no-js" lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Séries | Welcome</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.3/css/foundation.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/motion-ui/1.2.3/motion-ui.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.3/css/foundation-prototype.min.css">
  {{-- <link href='https://cdnjs.cloudflare.com/ajax/libs/foundicons/3.0.0/foundation-icons.css' rel='stylesheet' type='text/css'> --}}
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <!--<link rel="stylesheet" href="css/app.css">-->
</head>

<!-- Navigation bar CSS -->
<style>
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins',sans-serif;
  color: white;
}

body{
  background-color: black;
}

.top-bar {
  background-color: transparent;
}

.top-bar .menu{
  background-color: transparent;
  color: red;
  font-size: 1.2em;
}

.top-bar-right{
  z-index: 2;
  text-align: center;
  font-size: 1em;
}

.top-bar-left a, .top-bar-right a{
  color: white;
  font-size: 1em;
  text-decoration: none;
  padding-right: 20px;
  border-radius: 5px;
}
.top-bar-left a:hover{
  color: black;
  background-color: white;
  box-shadow: 1px 1px 2px 2px white;
  transition: 0.3s;
}
</style>

<body>

  <!-- Start Top Bar -->
  <div class="top-bar">
    <div class="top-bar-left">
      <ul class="menu">
        <li class="menu-text">Super Series</li>
        <li><a href="/">Menu</a></li>
        <li><a href="/series">Series</a></li>
        @auth
        <li><a href="{{ url('/profile/'.Auth::user()->id) }}">Mon profil</a></li>
        @endauth
        <li><a href="/contact">Contact</a></li>
        
      </ul>
    </div>
    <div class="top-bar-right">
      @if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
          @auth
              <!-- On affiche le pseudo de l'utilisateur -->
              <a href="{{ url('/profile/'.Auth::user()->id) }}" class="text-sm text-gray-700 dark:text-gray-500 underline">
                {{ Auth::user()->username }}</a> 
              @if (Route::has('logout'))
                <a href="{{ route('logout') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline" 
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
              @endif
            @else
              <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

            @if (Route::has('register'))
              <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
            @endif
          @endauth
        </div>
      @endif
    </div>
  </div>
  <!-- End Top Bar -->

  <!--
  <div class="callout large primary">
    <div class="text-center">
      <h1>Series</h1>
      <h2 class="subheader">Series Master</h2>
    </div>
  </div>

  <article class="grid-container">

  </article>-->

  @yield('content')



  <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.3/js/foundation.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/motion-ui/1.2.3/motion-ui.min.js"></script>
  <script>
    $(document).foundation();
  </script>
</body>
</html>