<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V2\CarAdResource;
use App\Http\Resources\OrderResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function me(Request $request)
    {
        return response(new UserResource($request->user()));
    }

    public function orders(Request $request)
    {
        $orders = $request->user()->orders()->latest();

        if ($request->page || $request->per_page) {
            $per_page = $request->per_page ?? 10;
            $orders = $orders->paginate($per_page);

            return OrderResource::collection($orders)->appends([
                'per_page' => $per_page
            ]);
        } else {
            $orders = $orders->get();
        }

        return OrderResource::collection($orders);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
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
                'success' => false
            ], 400);
        }

        User::find($request->user()->id)->update($request->post());

        return response([
            'message' => 'Your user information has been successfully updated',
            'success' => true
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
                'success' => false
            ], 400);
        }

        if (!Hash::check($request->current_password, $user->password)) {
            return response([
                'message' => 'Password not match',
                'success' => false
            ], 400);
        }

        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        return response([
            'message' => 'Your password has been successfully changed',
            'success' => true
        ], 200);
    }

    /**
     * @param Request $request
     */
    public function ads(Request $request)
    {
        $carAds = $request->user()->carAds()->latest();

        if ($request->page || $request->per_page) {
            $per_page = $request->per_page ?? 10;
            $carAds = $carAds->paginate($per_page);

            return CarAdResource::collection($carAds)->appends([
                'per_page' => $per_page
            ]);
        } else {
            $carAds = $carAds->get();
        }

        return CarAdResource::collection($carAds);
    }
}
