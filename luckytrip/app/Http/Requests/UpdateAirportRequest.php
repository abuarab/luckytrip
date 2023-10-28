<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAirportRequest extends FormRequest {
    public function rules(): array {

        return [
            'iata_code' => 'sometimes|max:3',
            'latitude' => 'sometimes|numeric|between:-90,90',
            'longitude' => 'sometimes|numeric|between:-180,180',

            'translations' => 'sometimes|array',
            'translations.*.language_code' => 'sometimes|required',
            'translations.*.name' => 'sometimes|max:60',
            'translations.*.description' => 'sometimes|max:500',
            'translations.*.terms_and_conditions' => 'sometimes|max:500',
        ];
    }
}
