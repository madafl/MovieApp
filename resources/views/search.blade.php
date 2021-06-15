@extends('layouts.main')

@section('content') 
    <div class="container" >
        <div><h3>Cautare dupa $word</h3></div>
        <div class="row" style="margin-top:20px;" >
                @foreach ($searchResults as $movie)
                    <div class="col-sm-3">
                    <x-movie-card :movie="$movie" :genres="$genres"/>
                    </div>
                @endforeach
        </div>
    </div>

 @endsection