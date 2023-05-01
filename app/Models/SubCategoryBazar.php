<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategoryBazar extends Model
{
    use HasFactory;
    protected $fillable=[
        'category_id',
        'name',
    ];

    public function bazar_category(){
        return $this->belongsTo(BazarCategory::class , 'category_id');
    }
}
