<?php

namespace App\Traits;

use Illuminate\Support\Facades\Validator;

use App\Defined\ApiResponse;

trait Validation
{
    public function validateRequest(array $request, array $validate, array $errors = [])
    {
        $validator = Validator::make($request, $validate);
        $response = ['status' => ApiResponse::SUCCESS];

        if ($validator->fails()) {
            $response['status'] = ApiResponse::UNDEFINED_ARGUMENT;
            $fails = $validator->failed();

            foreach ($errors as $key => $error) {
                if (isset($fails[$key])) {
                    $first_error = array_keys($fails[$key])[0];
                    $response['status'] = $error[$first_error];
                    break;
                }
            }
        }

        return $response;
    }
}
