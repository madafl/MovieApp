<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Watchlist extends Model
{
    use HasFactory;
    protected $table = 'watchlist';
    public function user(){
        return $this->belongsToMany(User::class, 'user_id'); 
    }
}
