<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V3\CarAdResource;
use App\Http\Resources\OrderResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function me(Request $request)
    {
        return response(new UserResource($request->user()->load('orders.orderProducts.product.translations')));
    }

    public function orders(Request $request)
    {
        return response(OrderResource::collection($request->user()->orders));
    }

    public function carAds(Request $request)
    {
        $carAds = $request->user()->carAds()->with([
            'carBody' => fn($query) => $query->with('translations'),
            'carColour' => fn($query) => $query->with('translations'),
            'carModel' => fn($query) => $query->with('carBrand'),
            'carPlace' => fn($query) => $query->with('translations'),
            'carTransmission' => fn($query) => $query->with('translations'),
            'carTypeOfDrive' => fn($query) => $query->with('translations'),
            'media'
        ])->latest()->get();

        return CarAdResource::collection($carAds);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|numeric|digits:8',
            'address' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response([
                'error' => $validator->errors(),
                'message' => 'Validation error',
            ], 400);
        }

        $user = User::find($request->user_id)->update($request->post());

        return response([
            'message' => 'Your user information has been successfully updated',
        ], 200);
    }

    public function changePassword(Request $request)
    {
        $user = $request->user();

        $validator = Validator::make($request->all(), [
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response([
                'error' => $validator->errors(),
                'message' => 'Validation error',
            ], 400);
        }

        if (!Hash::check($request->current_password, $user->password)) {
            return response([
                'message' => 'Password not match',
            ], 400);
        }

        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        return response([
            'message' => 'Your password has been successfully changed'
        ], 200);
    }
}
