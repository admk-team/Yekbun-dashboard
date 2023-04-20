<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bazar extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'user_name',
        'image',
        'category_id'
    ];

    public function bazar_category(){
        return $this->belongsTo(BazarCategory::class ,'category_id');
    }
}
