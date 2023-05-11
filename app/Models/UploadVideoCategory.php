<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadVideoCategory extends Model
{
    use HasFactory;
    protected $fillable=[
        'category'
    ];
}
