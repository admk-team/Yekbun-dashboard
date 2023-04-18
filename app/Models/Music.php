<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    use HasFactory;
    protected $fillable =[
      'name',
      'category_id',
      'audio',
      
    ];
    public function music_category(){
        return $this->belongsTo(MusicCategory::class , 'category_id' );
    }
}
