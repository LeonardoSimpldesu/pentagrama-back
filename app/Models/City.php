<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "uf",
        "foundedIn",
    ];
    public $timestamps = false;

    public function neighborhood()
    {
        return $this->hasMany(Neighborhood::class, 'city_id');
    }

    public function street()
    {
        return $this->hasManyThrough(Neighborhood::class, Street::class);
    }
}
