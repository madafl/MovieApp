<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class WatchedMovies extends Model
{
    use HasFactory;
    protected $table = 'watched_movies';
   
    public function user(){
        return $this->belongsToMany(User::class, 'user_id'); 
        //a user has many watched movies
    }

    
}
