<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadMovieCategory extends Model
{
    use HasFactory;
    protected $fillable =[
        'category'
    ];
}
