@extends('layouts.main')

@section('content') 
    <div class="container" >
        <div><h3>Filme populare</h3></div>
        <div class="row" style="margin-top:20px;" >
                @foreach ($popularMovies as $movie)
                    <div class="col-sm">
                    <x-movie-card :movie="$movie" :genres="$genres"/>
                    </div>
                @endforeach
        </div>
    </div>

 @endsection