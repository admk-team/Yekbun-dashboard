<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FanPage extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_name',
        'fanpage_name'
    ];
}
