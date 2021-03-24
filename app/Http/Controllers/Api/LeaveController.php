<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Defined\LeaveType;
use App\Defined\ApiResponse;

use App\Services\LeaveService;

class LeaveController extends ApiController
{
    public function reply(Request $request)
    {
        $leave_types = implode(',', LeaveType::all());
        $response = $this->validateRequest($request->all(), [
            'date' => 'required|date_format:Y-m-d',
            'type' => "required|in:$leave_types",
            'started_time' => 'required|date_format:H:i:s',
            'ended_time' => 'required|date_format:H:i:s'
        ], [
            'date' => [
                'Required' => ApiResponse::LEAVE_DATE_REQUIRED,
                'DateFormat' => ApiResponse::LEAVE_DATE_INVALID
            ],
            'type' => [
                'Required' => ApiResponse::LEAVE_TYPE_REQUIRED,
                'In' => ApiResponse::LEAVE_TYPE_NOT_FOUND
            ],
            'started_time' => [
                'Required' => ApiResponse::LEAVE_START_REQUIRED,
                'DateFormat' => ApiResponse::LEAVE_START_INVALID
            ],
            'ended_time' => [
                'Required' => ApiResponse::LEAVE_END_REQUIRED,
                'DateFormat' => ApiResponse::LEAVE_END_INVALID
            ]
        ]);

        if ($response['status'] === ApiResponse::SUCCESS) {
            $response = LeaveService::reply(auth()->id(),
                $request->date,
                $request->type,
                $request->started_time,
                $request->ended_time
            );
        }

        return response($response);
    }
}
