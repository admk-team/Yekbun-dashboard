<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
      'name',
      'code',
      'flag_path',
      'image_path',
      'icon_code',
      'capital_id',
      'language_id',
      'status',  
    ];

    public function regions()
    {
        return $this->hasMany(Region::class, 'country_id', 'id');
    }

    public function cities()
    {
        return $this->hasMany(City::class, 'country_id', 'id');
    }

    public function capital()
    {
        return $this->hasOne(City::class, 'capital_id', 'id');
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
