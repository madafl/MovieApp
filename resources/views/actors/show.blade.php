@extends('layouts.main')

@section('content')
    <div class="container" >

        <div><h3>{{$actor['name']}}</h3></div>
        <div class="row">
                <div class="col-sm-3" style="padding:10px;">
                    <a style="text-decoration:none;color:black;"> 
                    @if ($actor['profile_path'] != null)
                        <img class="card-img-top" src="{{ 'https://image.tmdb.org/t/p/w185/'.$actor['profile_path'] }}">
                        
                    @else
                        <img class="card-img-top" src= 'https://www.almamater.ro/wp-content/uploads/2020/02/No-picture-3.png'style="width:91%;" >
                        
                    @endif
                    </a>
                </div>  
                <div>
                    <h3> Filme </h3>
                    @foreach ($actorMovies['cast'] as $movie )
                        @if ($loop->index<10 )
                            <a href="{{route('movies.show', $movie['id'])}}" style="text-decoration:none;color: #e28613;"> <p>{{$movie['title']}} </p> </a>
                        @endif
                    @endforeach
                </div>
                <div>
                    <h3> Imagini</h3>
                    <div class="row">
                    
                        @foreach ($actor['images']['profiles'] as $image) 
                        <div class="col-sm-2" style="padding:10px;">
                            <img class="card-img-top" src="{{ 'https://image.tmdb.org/t/p/w185/'.$image['file_path'] }}">
                       </div>  
                       @endforeach
                   
                    </div>
                </div>
        </div>
    </div>
@endsection
