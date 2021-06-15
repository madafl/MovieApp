<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;



class SearchDropdown extends Component
{
    public $search = '';
  
    public function render()
    {
        $key= config('services.tmdb.token');
        $searchResults = [];
        $searchMovies = [];
        $searchPeople = [];
       
        if(strlen($this->search) > 1 ) {
            $searchMovies = Http::get('https://api.themoviedb.org/3/search/movie?api_key='.$key.'&language=ro-RO&query='.$this->search.'&page=1&include_adult=false')
                ->json()['results'];
            $searchPeople = Http::get('https://api.themoviedb.org/3/search/person?api_key='.$key.'&language=ro-RO&query='.$this->search.'&page=1&include_adult=false')
            ->json()['results'];
       }
        $searchResults = array_merge($searchMovies, $searchPeople);
        return view('livewire.search-dropdown', [
            'searchResults' => collect($searchResults)->take(5)
        ]);
    }
  
}