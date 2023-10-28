<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAirportRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array {

        return [
            'iata_code' => 'required|max:3|unique:airports,iata_code',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'translations' => 'array',

            'translations.*.language_code' => 'required',
            'translations.*.name' => 'required|max:60',
            'translations.*.description' => 'required|max:500',
            'translations.*.terms_and_conditions' => 'max:500',
        ];
    }
}
