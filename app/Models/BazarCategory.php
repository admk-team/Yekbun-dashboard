<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BazarCategory extends Model
{
    use HasFactory;
    protected $fillable=[
        'name'
    ];
    public function bazarsubcategory(){
        return $this->hasMany(SubCategoryBazar::class , 'category_id');
    }
}
