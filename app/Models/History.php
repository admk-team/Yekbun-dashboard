<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'category_id',
        'language'
    ];

    public function history_category(){
        return $this->belongsTo(HistoryCategory::class, 'category_id');
    }
}