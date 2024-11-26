<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\UserFilterRequest;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Services\UserService;
use App\Services\BranchService;
use App\Models\Role;

class UserController extends Controller
{
    public function __construct(
        protected UserService $userService,
        protected BranchService $branchService
    ) {   }

    public function index(UserFilterRequest $request)
    {
        $roles = Role::all();
        $users = $this->userService->index($request);
        $branches = $this->branchService->index();
        return view('admin.users.index',
                compact('users', 'branches', 'roles'));
    }

    public function create()
    {
        $branches = $this->branchService->index();
        return view('admin.users.create',
                    compact('branches'));
    }

    public function store(UserRequest $request)
    {
        $this->userService->store($request);
        return redirect()->route('users.index');
    }

    public function edit($id)
    {
        $roles = Role::all();
        $user = $this->userService->edit($id);
        $branches = $this->branchService->index();
        return view('admin.users.edit',
                compact('user', 'branches', 'roles'));
    }

    public function update(UserUpdateRequest $request, $id)
    {
        $this->userService->update($request, $id);
        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        $this->userService->destroy($id);
        return redirect()->route('users.index');
    }
}
