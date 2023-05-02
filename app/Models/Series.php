<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    use HasFactory;

    public function series_category(){
        return $this->belongsTo(Category::class , 'category_id')->where('target' , 'series');
    }

}
