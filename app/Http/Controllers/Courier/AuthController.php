<?php

namespace App\Http\Controllers\Courier;

use App\Data\CourierLoginData;
use App\Enums\RoleEnum;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * @throws AuthenticationException
     */
    public function login(CourierLoginData $data)
    {
        $user = User::query()
            ->where('phone_number', $data->phone_number)
            ->role(RoleEnum::COURIER)
            ->first();

        if (!$user) {
            return $this->errorResponse(
                'Courier not found',
                401
            );
        }

        if (!Hash::check($data->password, $user->password)) {
            new AuthenticationException('Courier login failed');
        }

        $token = auth('api')->login($user);

        return $this->successResponse([
                                          'token' => $token,
                                      ]);
    }
}
