<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadMovie extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'thumbnail',
        'description',
        'video',
        'category_id'
    ];

    public function moviecategory(){
        return $this->belongsTo(UploadMovieCategory::class , 'category_id');
    }
}
