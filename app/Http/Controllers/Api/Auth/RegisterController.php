<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|size:8',
            'address' => 'required'
        ]);

        if ($validator->fails()) {
            return response([
                'error' => $validator->errors(),
                'message' => 'Validation error',
            ], 400);
        }

        if ($request->user_type === 'company') {
            $validator = $this->validateCompany($request);

            if ($validator->fails()) {
                return response([
                    'error' => $validator->errors(),
                    'message' => 'Validation error',
                ], 400);
            }
        }

        $user = User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'address' => $request->address
        ]);

        if ($request->user_type === 'company') {
            $user->company()->create($request->post());
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 201);
    }

    public function validateCompany(Request $request)
    {
        return Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'website' => 'nullable',
            'tin' => 'required',
            'fax_address' => 'nullable|string|max:255',
            'about' => 'required|string'
        ]);
    }
}
