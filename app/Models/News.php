<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'description',
        'category_id',
        'image',
        'status'
    ];

    public function news_category(){
        return $this->belongsTo(NewsCategory::class , 'category_id' );
    }
}
