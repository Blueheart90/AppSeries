<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TvList extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'api_id', 'poster', 'season', 'episode', 'score_id', 'watching_state_id', 'user_id'
    ];

    // Una serie agregada a la tabla TvList pertenece a un User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Una serie pertenece a un estado
    public function watchingstate()
    {
        return $this->belongsTo(WatchingState::class);
    }

}