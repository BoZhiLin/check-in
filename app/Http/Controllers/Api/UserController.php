<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Services\CheckService;

class UserController extends ApiController
{
    public function getCheckRecords(Request $request)
    {
        $response = CheckService::getUserRecords(auth()->id(), $request->date);
        return response($response);
    }
}
