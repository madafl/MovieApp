<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">   
        <!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        -->
        <title>Movie App</title>
        <link rel="stylesheet" type="text/css" href="resources/css/app.css">
        <livewire:styles>
        <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
       
    </head>
    <body>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                <ul class="navbar-nav" style="display:contents;">
                
                    <li class="nav-item active"> <a class="nav-link" href="{{route('movies.index')}}"> <i class="fa fa-film" style="margin-right: 5px;color: #e28613;"></i>Acasa</a></li>
                    <!-- <li class="nav-item active"> <a class="nav-link" href="/movie">Recomandare de film</a></li> -->
                    <li class="nav-item active"> <a class="nav-link" href="{{route('actors.index')}}">Actori</a></li>
                    
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre id="dropdownProfile"
                            onclick="dropdownProfile();">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu " aria-labelledby="navbarDropdown" id="dropdownProf">
                            <a class="dropdown-item" href="{{ route('profile') }}">
                                {{('Profil') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{__('Logout') }}
                            </a>
                            
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </ul>
                    </li> 
                    @endguest
                    <li class="nav-item active" style="float: left; ">
                        <livewire:search-dropdown>
                    </li>
                    
                </ul>
                </div> 
        </nav>
        <div style="margin-top:20px;">
            @yield('content')
       
        </div>
        <livewire:scripts>
    </body>
</html>

<script type="text/javascript">
     function dropdownProfile() {
        var inputVal = document.getElementById("dropdownProfile");
        var dropdownElement = document.getElementById("dropdownProf");
        if (dropdownElement.style.display == "block") {
            dropdownElement.style.display = "none";
        }
        else{
            dropdownElement.style.display = "block";
        }
};
 
     function checkFilled() {
        var inputVal = document.getElementById("drp");
        var dropdownElement = document.getElementById("dropdown");
        if (inputVal.value == "") {
            dropdownElement.style.display = "none";
        }
        else{
            dropdownElement.style.display = "block";
        }
}
 </script>
