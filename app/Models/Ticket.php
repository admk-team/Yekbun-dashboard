<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'event_id',
        'name',
        'description',
        'price',
        'price_male',
        'price_female',
        'price_kids',
        'quantity',
        'total_sales',
        'start_sale',
        'end_sale',
        'status',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
