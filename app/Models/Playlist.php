<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    use HasFactory;

    
            protected $fillable = [
                "user_id",
                "playlist_name",
                "visibility",
                "music_id",
                "feed_id",
                "vote_id",
                "news_id",
                "history_id"
            ];

}
