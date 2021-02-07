<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Services\CheckInRecordService;

class CheckInRecordController extends ApiController
{
    public function signIn()
    {
        $user_id = auth()->id();
        $result = CheckInRecordService::signInByUser($user_id);
        return $result;
    }

    public function signOut()
    {
        $user_id = auth()->id();
        $result = CheckInRecordService::signOutByUser($user_id);
        return $result;
    }

    public function recoup(Request $request)
    {
        // TODO
    }
}
