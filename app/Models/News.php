<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\URL;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class News extends Model
{
    use HasFactory, LogsActivity;
    
    public $image_urls = [];
    protected $appends = ['image_urls'];
    protected $fillable=[
        'title',
        'description',
        'category_id',
        'image',
        'status'
    ];

    protected $casts = [
        'image' => 'array'
     ];
     protected $attributes = [
        'image' => '[]'
     ];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    public function news_category(){
        return $this->belongsTo(NewsCategory::class , 'category_id' );
    }

    public function getImageUrlsAttribute(){
        return  array_map(function($path){
          return URL::to(asset('storage/'.$path));
        },$this->image);
    }

    
}
