@extends('layouts.main')
    @section('content')
        <div class="container" >
        @if(Session::has('success'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
         {{ Session::get('message', '') }}
        </div>
        @elseif(Session::has('error'))
        <div class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
         {{ Session::get('message', '') }}
        </div>
        @endif 

       <div>
       <h3> Filme vazute</h3>
         <div class="row">
            @foreach($watchedMovies as $movie)
                <div class="col-sm-3">
                    <a href="{{route('movies.show', $movie['id'])}}" style="text-decoration:none;color:black"> 
                        <img class="card-img-top" src="{{ 'https://image.tmdb.org/t/p/w185/'.$movie['poster_path'] }}" style="width:70%;padding:5px;">
                        <p>{{ $movie['title']}}</p>
                    </a>
                    <form action="{{ route('deleteWatched', $movie['id']) }}" method="POST">
                        @csrf
                    <button type="submit" class="btn btn-danger" value="{{$movie['id']}}" name="watched" style="font-size:12px;">Elimina</button>
                    </form>     
                </div>
            @endforeach     
        </div>  
       <div>
       <h3> Filme de vazut</h3> 
        <div class="row">
            @foreach($watchlistMovies as $movie)
                <div class="col-sm-3">
                    <a href="{{route('movies.show', $movie['id'])}}" style="text-decoration:none;color:black"> 
                        <img class="card-img-top" src="{{ 'https://image.tmdb.org/t/p/w185/'.$movie['poster_path'] }}" style="width:70%;padding:5px;">
                        <p>{{ $movie['title']}}</p>
                    </a>
                    <form action="{{ route('deleteWatchlist', $movie['id']) }}" method="POST">
                        @csrf
                    <button type="submit" class="btn btn-danger" value="{{$movie['id']}}" name="watchlist" style="font-size:12px;">Elimina</button>
                    </form>
                </div>
        @endforeach
        </div>
       </div>
    </div>
@endsection
