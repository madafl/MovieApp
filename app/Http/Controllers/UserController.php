<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;


class UserController extends Controller
{
    public function index(){
        $key= config('services.tmdb.token');
        $id= Auth::id();
        $watchedMoviesID = DB::table('watched_movies')
                        ->select('movie_id')
                        ->where('user_id', $id)->pluck('movie_id');
        $watchedMovies = [];
        foreach ($watchedMoviesID as $movie) {
        $m = Http::get('https://api.themoviedb.org/3/movie/'.$movie .'?api_key='.$key.'&language=ro-RO&append_to_response=credits,videos,images')
        ->json();
        array_push($watchedMovies, $m);
        }

        $watchlistMoviesID = DB::table('watchlist')
        ->select('movie_id')
        ->where('user_id', $id)->pluck('movie_id');

        $watchlistMovies = [];
        foreach ($watchlistMoviesID as $movie) {
        $m = Http::get('https://api.themoviedb.org/3/movie/'.$movie .'?api_key='.$key.'&language=ro-RO&append_to_response=credits,videos,images')
        ->json();
        array_push($watchlistMovies, $m);
        }
        $genresArray= Http::get('https://api.themoviedb.org/3/genre/movie/list?api_key='.$key.'&&language=ro-RO')
            ->json()['genres'];

        $genres = collect($genresArray)->mapWithKeys(function ($genre){
            return[$genre['id']=>$genre['name']];
        });

        return view('profile',[
            'watchedMovies' => $watchedMovies,  
            'watchlistMovies' =>$watchlistMovies,
            'genres' => collect($genres)->take(2),
        ]);
       
    }
}
