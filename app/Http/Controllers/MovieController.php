<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use App\Models\WatchedMovies;
use App\Models\Watchlist;
use Redirect;

//in config-services punem api key
class MovieController extends Controller
{
    public $search = '';
    public function index(){
        $key= config('services.tmdb.token');

        $popularMovies= Http::get('https://api.themoviedb.org/3/movie/popular?api_key='.$key.'&language=ro-RO') //cum trimit parametrii?
        ->json()['results'];

        $popularTvSeries = Http::get('https://api.themoviedb.org/3/tv/popular?api_key='.$key.'&language=ro-RO')
            ->json()['results'];


        $genresArray= Http::get('https://api.themoviedb.org/3/genre/movie/list?api_key='.$key.'&&language=ro-RO')
            ->json()['genres'];

           $genres = collect($genresArray)->mapWithKeys(function ($genre){
            return[$genre['id']=>$genre['name']];
        });
        
        
        return view('index',[
            'popularMovies' => $popularMovies,  //in view accesez vectorul cu popularMovies
            'popularTvSeries' => $popularTvSeries,
            'genres' => collect($genres)->take(2),
        ]);
    }

    public function show($id){
        $key= config('services.tmdb.token');
       //append pentru a accesa actori, poze, video
        $movie= Http::get('https://api.themoviedb.org/3/movie/'.$id .'?api_key='.$key.'&language=ro-RO&append_to_response=credits,videos,images')
            ->json();
        return view('show',[
            'movie' => $movie
        ]);
    }

    public function watched(Request $request){
        $input = $request->all();
        $id= Auth::id();
       
       $count = DB::table('watched_movies')
                    ->select('user_id')
                    ->where('movie_id', $request->input('watched'))
                    ->count();
        if($count == 1){
            return Redirect::to('/profile')->with('error', true)->with('message','Filmul exista deja in lista ta!');
        } else {
            $movie = new WatchedMovies();
            $movie->user_id = $id;
            $movie->movie_id = $request->input('watched');
            $movie->save();    
            return Redirect::to('/profile')->with('success', true)->with('message','Filmul a fost adaugat in lista ta!');
        } 
    }

    public function watchlist(Request $request){
        $input = $request->all();
        $id= Auth::id();
        $count = DB::table('watchlist')
                    ->select('user_id')
                    ->where('movie_id', $request->input('watchlist'))
                    ->count();
        if($count == 1){
            return Redirect::to('/profile')->with('error', true)->with('message','Filmul exista deja in lista ta!');
        } else {
            $movie = new Watchlist();
            $movie->user_id = Auth::id();
            $movie->movie_id = $request->input('watchlist');
            $movie->save();    
            return Redirect::to('/profile')->with('success', true)->with('message','Filmul a fost adaugat in lista ta!');
        }
    }

    public function showWatchlist(Request $request){
        $id = Auth::id();
        $watchedMovies =DB::table('watched_movies')
                        ->select('movie_id')
                        ->where('user_id', $id);
                       
        $watchlistMovies =DB::table('watchlist')
        ->select('movie_id')
        ->where('user_id', $id);
        return view('profile',[
            'watchedMovies' => $watchedMovies,  
            'watchlistMovies' =>$watchlistMovies
        ]);
    }
    public function deleteWatched(Request $request){
        $id = Auth::id();
        $input = $request->all();

        $movieid = $request->input('watched');
        $movie = DB::table('watched_movies')
            ->select('id')
            ->where('user_id', $id)
            ->where('movie_id', $movieid);
        $movie->delete();
        return Redirect::to('/profile')->with('success', true)->with('message','Filmul a fost sters!');
    }
   
    public function deleteWatchlist(Request $request){
        $id = Auth::id();
        $input = $request->all();

        $movieid = $request->input('watchlist');
        $movie = DB::table('watchlist')
            ->select('id')
            ->where('user_id', $id)
            ->where('movie_id', $movieid);
       if($movie != null){
            $movie->delete();
        return Redirect::to('/profile')->with('success', true)->with('message','Filmul a fost sters!');
        } else {
            return Redirect::to('/profile')->with('error', true)->with('message','Eroare!');
        }
    }

    
    public function search(Request $request){
        $input = $request->all();
        $word =  $request->input('search');
        dd($word);
        return view('search');
    }
}