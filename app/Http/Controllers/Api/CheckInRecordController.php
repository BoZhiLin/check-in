<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Services\CheckInRecordService;

class CheckInRecordController extends ApiController
{
    public function checkIn()
    {
        $response = CheckInRecordService::checkInByUser(auth()->id());
        return response($response);
    }

    public function checkOut()
    {
        $response = CheckInRecordService::checkOutByUser(auth()->id());
        return response($response);
    }

    public function recoup(Request $request)
    {
        // TODO
    }
}
