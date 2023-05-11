<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'category_id',
        'images'
    ];

    public function media_category(){
        return $this->belongsTo(MediaCategory::class, 'category_id');
    }
}
