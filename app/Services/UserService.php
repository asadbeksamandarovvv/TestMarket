<?php

namespace App\Services;

use App\Data\UserFilterData;
use App\Enums\RoleEnum;
use App\Events\AttachmentEvent;
use App\Http\Requests\UserFilterRequest;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;

class UserService
{
    public function index(UserFilterRequest $request)
    {
        return User::query()
            ->with(['role', 'branch', 'image'])
            ->when($request->role_id, function ($query) use ($request) {
                $query->whereHas('role', function ($query) use ($request) {
                    $query->where('id', $request->role_id);
                });
            })            ->orderBy('id')
            ->paginate(10);
    }

    public function store(UserRequest $request)
    {
        $user = User::query()->create($request->validated());
        if (request()->hasFile('image')) {
            event(new AttachmentEvent($request->image, $user->image()));
        }

        $user->assignRole($request->role);

        return $user;
    }

    public function edit($id)
    {
        return User::query()
            ->findOrFail($id);
    }

    public function update(UserUpdateRequest $request, $id)
    {
        $user = User::query()
            ->with(['role', 'image'])
            ->findOrFail($id);

        $user->update($request->validated());

        if (request()->hasFile('image')) {
            event(new AttachmentEvent($request->image, $user->image()));
        }

        if ($user->role()->first()) {
            $user->removeRole($user->role()->first()?->name);
        }

        $user->assignRole($request->role);
    }

    public function destroy($id)
    {
        return User::query()
            ->findOrFail($id)
            ->delete();
    }
}
