<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportVideo extends Model
{
    use HasFactory;
    public function video(){
        return $this->belongsTo(UplaodVideo::class , 'video_id');
    }
}
