<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Services\UserService;
use App\Services\CheckService;
use App\Services\LeaveService;

class UserController extends ApiController
{
    public function getInfo()
    {
        $response = UserService::getInfo(auth()->id());
        return response($response);
    }

    public function getCheckRecords(Request $request)
    {
        $response = CheckService::getUserRecords(auth()->id(), $request->date);
        return response($response);
    }

    public function getLeaveRecords(Request $request)
    {
        $response = LeaveService::getUserRecords(auth()->id(), $request->date);
        return response($response);
    }
}
