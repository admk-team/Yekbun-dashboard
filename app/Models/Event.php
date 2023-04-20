<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'event_category_id',
        'user_id',
        'start_time',
        "end_time",
        "location",
        "status",
    ];

    public function category()
    {
        return $this->belongsTo(EventCategory::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
