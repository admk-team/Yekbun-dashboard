<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentOffice extends Model
{
    use HasFactory;

    protected $fillable = [
        'office_name',
        'name',
        'last_name',
        'email',
        'phone',
        'country',
        'city',
        'address',
        'image_path',
        'status'
    ];
}
