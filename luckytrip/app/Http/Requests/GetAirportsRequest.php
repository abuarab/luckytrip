<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetAirportsRequest extends FormRequest {
    public function rules() {
        return [
            'name' => 'nullable|string|max:60',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'order' => 'nullable|in:asc,desc',
        ];
    }
}
