<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class News extends Model
{
    use HasFactory, LogsActivity;
    
    protected $fillable=[
        'title',
        'description',
        'category_id',
        'image',
        'status'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    public function news_category(){
        return $this->belongsTo(NewsCategory::class , 'category_id' );
    }
}
