<?php

namespace App\Services\Country;

use App\Models\Country;
use App\Services\Response\ResponseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class CountryService
{
    public function getCountries(): JsonResponse
    {
        $countries = Country::all();

        if ($countries) {
            return ResponseService::sendJsonResponse(true, 200, [], [
                'countries' => $countries,
            ]);
        } else {
            return ResponseService::sendJsonResponse(false, 400, [
                'Error' => 'Oops, something goes wrong'
            ]);
        }
    }

}
