<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Services\CheckInRecordService;

class CheckInRecordController extends ApiController
{
    public function signIn()
    {
        $user_id = auth()->id();
        $result = CheckInRecordService::signIn($user_id);
        return $result;
    }

    public function signOut()
    {
        $user_id = auth()->id();
        $result = CheckInRecordService::signOut($user_id);
        return $result;
    }

    public function recoup(Request $request)
    {
        // TODO
    }
}
