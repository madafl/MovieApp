@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
                <img class="card-img-top img-fluid" src="{{ 'https://image.tmdb.org/t/p/w185/'.$movie['poster_path'] }}" style="width:250px;">
                <div class="col-sm">
                <div class="row">
                    <div class="col-sm-3">
                        <form action="{{ route('watchlist', $movie['id']) }}" method="POST">
                            @csrf 
                            <button type="submit" class="btn btn-info" value="{{$movie['id']}}" name="watchlist" > Vreau sa vad </button>
                        </form>
                    </div>
                    <div class="col-sm-3">
                        <form action="{{ route('watched', $movie['id']) }}" method="POST">
                            @csrf 
                            <button type="submit" class="btn btn-info" value="{{$movie['id']}}" name="watched"> Vazut </button>
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
        </div>       
            @if (count($movie['videos']['results']) >0)
                <div> Trailer</div>
                <a href="https://youtube.com/watch?v={{ $movie['videos']['results'][0]['key'] }}"  ></a>
                <div>
            @endif
        
            <h3>Crew</h3>
            @foreach($movie['credits']['crew'] as $crew)
                @if ($loop->index<5 )

                    <div>{{ $crew['name'] }} {{ $crew['job'] }} </div>
                @endif
            @endforeach
        
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
       
    <!-- </div> -->
@endsection

<!-- daca filmule  in db  schimba clasa cu class="btn btn-success"
daca filmule e in watched/watchlist nu poate fi si in celalalt -->