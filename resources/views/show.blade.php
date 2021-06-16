@extends('layouts.main')

@section('content')
<div class="container">
        <div class="row">
        <div>
            <h3>{{$movie['title']}}</h3>
            <img class="card-img-top img-fluid" src="{{ 'https://image.tmdb.org/t/p/w185/'.$movie['poster_path'] }}" style="width:250px;">
        </div>
            <div class="col-sm" style="margin-top:40px;">
                <div class="row">
                    <div class="col-sm-3">
                        <form action="{{ route('watchlist', $movie['id']) }}" method="POST">
                            @csrf 
                            @if($isMovieWatchlist == 1)
                            <button type="submit" class="btn " value="{{$movie['id']}}" name="watchlist" style="width:130px;background-color:#e28613;color:white"> Vreau sa vad </button>
                            @else
                            <button type="submit" class="btn btn-info" value="{{$movie['id']}}" name="watchlist" style="width:130px;"> Vreau sa vad </button>
                            @endif
                        </form>
                    </div>
                    <div class="col-sm-3">
                        <form action="{{ route('watched', $movie['id']) }}" method="POST">
                            @csrf 
                            @if($isMovieWatched == 1)
                            <button type="submit" class="btn " value="{{$movie['id']}}" name="watched" style="width:130px;background-color:#e28613;color:white"> Vazut </button>
                            @else
                            <button type="submit" class="btn btn-info" value="{{$movie['id']}}" name="watched" style="width:130px;"> Vazut </button>
                            @endif
                        </form>
                    </div>
                </div>
                <div style="margin-top:20px;">
                    <p>Pemiera:
                            {{$movie['release_date'] }}
                    </p>
                    <p>Genuri:
                        @foreach ($movie['genres'] as $genre )
                        <!-- $genre este idul genului si cheia, cauta in vectorul $genres care contine toate genurile si afiseaza valoarea-->
                            {{$genre['name']}}  @if (!$loop->last), @endif
                        @endforeach
                    </p>
                </div>
                
                </div>
                @if (($movie['overview']))
                    <div>
                        <h3 style="font-weight:bold"> Descriere</h3>
                        <p> {{ $movie['overview']}} </p>
                    </div>
                @endif

        </div>   
        <div>    
            @if (count($movie['videos']['results']) > 0)
                <div> Trailer</div>
                <a href="https://youtube.com/watch?v={{ $movie['videos']['results'][0]['key'] }}"  ></a>
                <div>
            @endif
            <hr>
            <h3>Crew</h3>
            @foreach($movie['credits']['crew'] as $crew)
                @if ($loop->index<5 )

                    <div>{{ $crew['name'] }} {{ $crew['job'] }} </div>
                @endif
            @endforeach
        <hr>
            <h3>Cast</h3>
                <div style="display:flex">
                    @foreach ($movie['credits']['cast'] as $cast)
                        @if ($loop->index <5)
                        <a href="{{route('actors.show', $cast['id'])}}" style="text-decoration:none;color:black;padding:10px;width:30%">
                                @if ($cast['profile_path'] != null)
                                    <img  class="card-img-top" src="{{ 'https://image.tmdb.org/t/p/w185/'.$cast['profile_path'] }}" >
                                    <div>{{ $cast['name'] }} - {{$cast['character']}} </div>
                                @else
                                    <img  class="card-img-top" src= 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT1Zco_AzlB5030ccqs-SkdHxO_PmzfBw5sjXSKCjfaX46A9-YEg-9_vjqAHsvgQTw3kbw&usqp=CAU' >
                                    <div>{{ $cast['name'] }} - {{$cast['character']}} </div>
                                @endif
                        </a>
                        @endif
                    @endforeach
                    </div>
                
    </div>
       
    <!-- </div> -->
@endsection

<!-- daca filmule  in db  schimba clasa cu class="btn btn-success"
daca filmule e in watched/watchlist nu poate fi si in celalalt -->