<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    use HasFactory;

    protected $fillable=[
        'title',
        'description',
        'status',
        'media',
        'type'
    ];

    public function background(){
        return $this->hasMany(BackgroundFeed::class  , 'id' , 'background_id');
    }

  
}
