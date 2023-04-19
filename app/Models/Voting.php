<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voting extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'category_id',
        'description',
        'image'
    ];
    public function voting_category(){
        return $this->belongsTo(VotingCategory::class , 'category_id');
    }
}
