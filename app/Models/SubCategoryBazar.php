<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubCategoryBazar extends Model
{
    use HasFactory , LogsActivity;
    protected $fillable=[
        'category_id',
        'name',
    ];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }
    public function bazar_category(){
        return $this->belongsTo(BazarCategory::class , 'category_id');
    }
}
