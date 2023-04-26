<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UplaodVideo extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'thumbnail',
        'description',
        'video',
        'category_id'
    ];

    public function videocategory(){
        return $this->belongsTo(UploadVideoCategory::class , 'category_id');
    }
}
