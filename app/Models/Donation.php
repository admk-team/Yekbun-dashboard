<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'organization_id',
        'tags',
        'start_date',
        "end_date",
        'status',
    ];

    protected $casts = [
        'tags' => 'array',
        'start_date' => 'datetime:Y-m-d',
        'end_date' => 'datetime:Y-m-d',
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}
