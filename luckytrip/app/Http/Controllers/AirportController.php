<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAirportRequest;
use App\Http\Requests\UpdateAirportRequest;
use App\Services\AirportService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\GetAirportsRequest;
use App\Repositories\AirportRepository;

class AirportController extends Controller
{
    protected $airportService;
    private $airportRepository;

    public function __construct(AirportService $airportService, AirportRepository $airportRepository) {
        $this->airportService = $airportService;
        $this->airportRepository = $airportRepository;
    }

    /**
     * @param $airportId
     * @return JsonResponse
     *
     * get airport by id
     */
    public function show($airportId): JsonResponse {
        return $this->airportService->getAirportById($airportId);
    }

    /**
     * @param CreateAirportRequest $request
     * @return JsonResponse
     *
     * create airport
     */
    public function store(CreateAirportRequest $request) : JsonResponse {
        return $this->airportService->createAirport($request->all());
    }

    /**
     * @param UpdateAirportRequest $request
     * @param $airportId
     * @return JsonResponse
     *
     * update airport
     */
    public function update(UpdateAirportRequest $request, $airportId) {
        return $this->airportService->updateAirport($request, $airportId);
    }

    /**
     * @param Request $request
     * @param $airportId
     * @return JsonResponse
     *
     * delete airport
     */
    public function delete($airportId) {
        return $this->airportService->deleteAirport($airportId);
    }

    /**
     * @param GetAirportsRequest $request
     * @return JsonResponse
     *
     * get airports
     */
    public function get(GetAirportsRequest $request) {

        $filters = [
            'name' => $request->input('name'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'order' => $request->input('order'),
        ];

        $filteredQuery = $this->airportRepository->getAllFiltered($filters);

        $airports = $filteredQuery->with('translations')->limit(5)->get();

        return response()->json($airports);
    }



}
