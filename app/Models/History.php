<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class History extends Model
{
    use HasFactory, LogsActivity;
    
    protected $fillable=[
        'title',
        'category_id',
        'language',
        'image',
        'video'
    ];

    protected $casts = [
        'image' => 'array',
        'video' => 'array',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    public function history_category(){
        return $this->belongsTo(HistoryCategory::class, 'category_id');
    }
    public function getCreatedAtAttribute($value)
    {
        // Format the created_at attribute as desired
        return $this->attributes['created_at'] = $this->asDateTime($value)->format('Y-m-d H:i:s');
    }
    public function getUpdatedAtAttribute($value)
    {
        // Format the updated_at attribute as desired
        return $this->attributes['updated_at'] = $this->asDateTime($value)->format('Y-m-d H:i:s');
    }

    public function gallery(){
        return $this->hasMany(PostGallery::class);
    }
}
