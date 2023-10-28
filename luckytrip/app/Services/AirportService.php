<?php

namespace App\Services;

use App\Models\Airport;
use App\Models\AirportTranslation;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\UpdateAirportRequest;

class AirportService {

    /**
     * @param $airportId
     * @return Builder|Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     *
     * get airport by id
     */
    public function getAirportById($airportId) {
        $airport = Airport::with('translations')->find($airportId);

        if ($airport) {
            return response()->json($airport, 200);
        } else {
            return response()->json(['message' => 'Airport not found'], 404);
        }
    }

    /**
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     *
     * create airport
     */
    public function createAirport($data) {
        $airport = new Airport($data);

        if ($airport->save()) {
            $translationsData = $data['translations'];

            foreach ($translationsData as $translation) {
                $translation['airport_id'] = $airport->id;
                AirportTranslation::create($translation);
            }

            return response()->json(['message' => 'Airport and translations created successfully'], 201);
        }

        return response()->json(['error' => 'Failed to create airport and translations'], 500);
    }

    /**
     * @param UpdateAirportRequest $request
     * @param $airportId
     * @return \Illuminate\Http\JsonResponse
     *
     * update airport
     */
    public function updateAirport(UpdateAirportRequest $request, $airportId) {

        $airportResponse = $this->getAirportById($airportId);

        if ($airportResponse->isSuccessful()) {
            $airport = $airportResponse->getOriginalContent();
            $airport->fill($request->validated());
            $airport->save();

            if (isset($request['translations']) && is_array($request['translations'])) {
                $this->updateTranslations($airport, $request['translations']);
            }

            return response()->json(['message' => 'Airport updated successfully'], 200);
        }

        return $airportResponse;
    }

    /**
     * @param Airport $airport
     * @param array $translations
     * @return void
     *
     * update translations
     */
    private function updateTranslations(Airport $airport, array $translations) {
        foreach ($translations as $translation) {
            $languageCode = $translation['language_code'];

            $existingTranslation = $airport->translations()->where('language_code', $languageCode)->first();

            if ($existingTranslation) {
                $existingTranslation->update($translation);
            } else {
                $airport->translations()->create($translation);
            }
        }
    }

    /**
     * @param $airportId
     * @return Builder|Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|\Illuminate\Http\JsonResponse|null
     *
     * delete airport
     */
    public function deleteAirport($airportId) {

        $airport = $this->getAirportById($airportId);

        if ($airport->isSuccessful()) {
            $airportModel = json_decode($airport->getOriginalContent());
            Airport::destroy($airportModel->id);
            return response()->json(['message' => 'Airport deleted successfully'], 204);
        }

        return $airport;
    }

}
