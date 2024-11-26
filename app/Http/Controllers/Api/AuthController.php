<?php

namespace App\Http\Controllers\Api;

use App\Data\LoginData;
use App\Data\LoginVerifyData;
use App\Data\UpdateMeData;
use App\Enums\RoleEnum;
use App\Events\AttachmentDestroyEvent;
use App\Events\AttachmentEvent;
use App\Http\Actions\TelegramNotification;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class AuthController extends Controller
{
    public function login(LoginData $data)
    {
        if ($data->phone_number == '998972113351')
        {
            $code = 1234;
        } else {
            $code = rand(1000, 9999);
        }
        cache()->put('auth_code_' . $data->phone_number, $code, 60);
        (new TelegramNotification())("Auth code $data->phone_number - " . $code);

        return $this->successResponse();
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function verify(LoginVerifyData $data)
    {
        $code = cache()->get('auth_code_' . $data->phone_number);

        if (!$code) {
            return $this->errorResponse('Code expired', 200);
        }

        if ($code == $data->code) {
            $user = User::query()
                ->where('phone_number', $data->phone_number)
                ->role(RoleEnum::MEMBER)
                ->first();

            if (!$user) {
                $user = User::query()
                    ->create([
                                 'phone_number' => $data->phone_number,
                                 'full_name'    => 'User',
                             ]);
                $user->assignRole(RoleEnum::MEMBER);
            }

            $token = auth('api')->login($user);

            return $this->successResponse([
                                              'token' => $token,
                                              'user'  => new UserResource($user),
                                          ]);
        }

        return $this->errorResponse('Invalid code', 200);
    }

    public function logout()
    {
        auth('api')->logout();
    }

    public function getMe()
    {
        $user = User::query()
            ->with(['image'])
            ->find(auth()->id());

        return $this->successResponse(new UserResource($user));
    }

    public function updateMe(UpdateMeData $data)
    {
        $user = User::query()
            ->find(auth()->id());

        $user->update([
                          'full_name' => $data->full_name,
                      ]);

        if ($data->image) {
            event(new AttachmentDestroyEvent($user->image));
            $user->image()->delete();
            event(new AttachmentEvent($data->image, $user->image()));
        }

        return $this->successResponse(new UserResource($user->load('image')));
    }
}
