<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Street extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "neighborhood_id",
    ];
    public $timestamps = false;

    public function neighborhood()
    {
        return $this->belongsTo(Neighborhood::class);
    }
}
