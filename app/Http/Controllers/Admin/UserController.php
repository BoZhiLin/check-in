<?php

namespace App\Http\Controllers\Admin;

use Latrell\Lock\Facades\Lock;

use Illuminate\Http\Request;

use App\Defined\ApiResponse;

use App\Services\UserService;

class UserController extends AdminController
{
    public function index()
    {
        $response = UserService::getUsers();
        return response($response);
    }

    public function store(Request $request)
    {
        $lock_key = 'action@add_user';

        try {
            Lock::acquire($lock_key);

            ['rules' => $rules, 'messages' => $messages] = $this->handleValidation();
            $response = $this->validateRequest($request->all(), $rules, $messages);
    
            if ($response['status'] === ApiResponse::SUCCESS) {
                $response = UserService::addUser($request->only([
                    'name', 'gender', 'id_number', 'birthday', 'address',
                    'username', 'password', 'phone', 'report_date', 'remark'
                ]));
            }
    
            return response($response);
        } finally {
            Lock::release($lock_key);
        }
    }

    public function update(Request $request, int $user_id)
    {
        ['rules' => $rules, 'messages' => $messages] = $this->handleValidation($user_id);
        $response = $this->validateRequest($request->all(), $rules, $messages);

        if ($response['status'] === ApiResponse::SUCCESS) {
            $response = UserService::setUser($user_id, $request->only([
                'name', 'gender', 'id_number', 'birthday',
                'address', 'phone', 'report_date', 'remark'
            ]));
        }

        return response($response);
    }

    public function destroy(int $user_id)
    {
        $response = UserService::removeUser($user_id);
        return response($response);
    }

    protected function handleValidation(int $id = 0)
    {
        $rules = [
            'name' => 'required',
            'gender' => 'required|in:MALE,FEMALE',
            'birthday' => 'required|date',
            'address' => 'required',
            'phone' => 'required',
            'report_date' => 'required|date',
            'remark' => 'nullable'
        ];

        if ($id) {
            $rules['id_number'] = 'required|unique:users,id_number,' . $id;
        } else {
            $rules['id_number'] = 'required|unique:users';
            $rules['username'] = 'required|unique:users';
            $rules['password'] = 'required';
        }

        $messages = [
            'name' => [
                'Required' => ApiResponse::USER_NAME_REQUIRED,
            ],
            'gender' => [
                'Required' => ApiResponse::USER_GENDER_REQUIRED,
                'In' => ApiResponse::USER_GENDER_NOT_FOUND,
            ],
            'id_number' => [
                'Required' => ApiResponse::USER_ID_REQUIRED,
                'Unique' => ApiResponse::USER_ID_EXISTS,
            ],
            'birthday' => [
                'Required' => ApiResponse::USER_BIRTHDAY_REQUIRED,
                'Date' => ApiResponse::USER_BIRTHDAY_INVALID,
            ],
            'address' => [
                'Required' => ApiResponse::USER_ADDRESS_REQUIRED,
            ],
            'username' => [
                'Required' => ApiResponse::USER_ACCOUNT_REQUIRED,
                'Unique' => ApiResponse::USER_ACCOUNT_EXISTS,
            ],
            'password' => [
                'Required' => ApiResponse::USER_PASSWORD_REQUIRED,
            ],
            'phone' => [
                'Required' => ApiResponse::USER_PHONE_REQUIRED,
            ],
            'report_date' => [
                'Required' => ApiResponse::USER_REPORT_REQUIRED,
                'Date' => ApiResponse::USER_REPORT_INVALID,
            ]
        ];

        return [
            'rules' => $rules,
            'messages' => $messages
        ];
    }
}
