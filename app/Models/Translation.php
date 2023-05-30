<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    use HasFactory;
    protected $fillable =[
        'text_id',
        'translation',
        'language_id',
        'language_code',
    ];
}
