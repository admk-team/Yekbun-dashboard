<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PostGallery extends Model
{
    use HasFactory;
    
    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($gallery) {
            Storage::delete($gallery->media_url); 
        });
    }
    public function post(){
        return $this->belongsTo(Post::class);
    }
   
}