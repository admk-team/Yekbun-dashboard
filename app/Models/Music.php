<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Music extends Model
{
    use HasFactory, LogsActivity;
    
    protected $fillable =[
      'name',
      'category_id',
      'audio',
      'popular',
      'artist_id'
      
    ];
    protected $casts = [
        'audio' => 'array'
     ];
     protected $attributes = [
        'audio' => '[]'
     ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    public function music_category(){
        return $this->belongsTo(MusicCategory::class , 'category_id' );
    }

    public function artist(){
        return $this->belongsTo(Artist::class , 'artist_id');
    }
}
