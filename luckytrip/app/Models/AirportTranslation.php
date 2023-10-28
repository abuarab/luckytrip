<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AirportTranslation extends Model{
    use HasFactory;

    protected $fillable = ['airport_id', 'language_code', 'name', 'description', 'terms_and_conditions'];

    public function airport() {
        return $this->belongsTo(Airport::class);
    }
}
