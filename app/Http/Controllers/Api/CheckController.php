<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Defined\ApiResponse;

use App\Services\CheckService;

class CheckController extends ApiController
{
    public function checkIn(Request $request)
    {
        $response = $this->validateRequest($request->all(), [
            'time' => 'required|date_format:H:i:s'
        ], [
            'time' => [
                'Required' => ApiResponse::CHECK_TIME_REQUIRED,
                'DateFormat' => ApiResponse::CHECK_TIME_INVALID
            ]
        ]);

        if ($response['status'] === ApiResponse::SUCCESS) {
            $response = CheckService::checkIn(auth()->id(), $request->time);
        }

        return response($response);
    }

    public function checkOut(Request $request)
    {
        $response = $this->validateRequest($request->all(), [
            'time' => 'required|date_format:H:i:s'
        ], [
            'time' => [
                'Required' => ApiResponse::CHECK_TIME_REQUIRED,
                'DateFormat' => ApiResponse::CHECK_TIME_INVALID
            ]
        ]);
        
        if ($response['status'] === ApiResponse::SUCCESS) {
            $response = CheckService::checkOut(auth()->id(), $request->time);
        }

        return response($response);
    }
}
