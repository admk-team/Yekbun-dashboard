<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bazar extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'image',
        'category_id',
        'user_id',
        'price',
        'status',
        'warranty'
    ];
    public function getImageAttribute($value)
    {
        return json_decode($value);
    }

    public function setImageAttribute($value)
    {
        $this->attributes['image'] = json_encode($value);
    }
    public function bazar_category(){
        
        return $this->belongsTo(BazarCategory::class ,'category_id');
    }
}
