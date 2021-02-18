<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TvList extends Model
{
    use HasFactory;

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
