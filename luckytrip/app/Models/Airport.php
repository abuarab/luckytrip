<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
    use HasFactory;

    protected $fillable = ['iata_code', 'latitude', 'longitude'];

    public function translations() {
        return $this->hasMany(AirportTranslation::class);
    }
}
