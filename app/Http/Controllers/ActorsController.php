<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ActorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $key= config('services.tmdb.token');

        $popularActors= Http::get('https://api.themoviedb.org/3/person/popular?api_key='.$key.'&language=ro-RO') //cum trimit parametrii?
        ->json()['results'];
        return view('actors.index',[
            'popularActors' => $popularActors,  
        ]
    );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $key= config('services.tmdb.token');
        //append pentru a accesa actori, poze, video
                $actor= Http::get('https://api.themoviedb.org/3/person/'.$id .'?api_key='.$key.'&language=ro-RO&append_to_response=credits,videos,images')
                    ->json();
                $actorMovies = Http::get('https://api.themoviedb.org/3/person/'.$id .'/movie_credits?api_key='.$key.'&language=ro-RO')
                ->json();
                return view('actors.show',[
                    'actor' => $actor,
                    'actorMovies' => $actorMovies
                ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
