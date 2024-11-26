<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\BranchRequest;
use App\Http\Requests\BranchUppdateRequest;
use App\Services\BranchService;

class BranchController extends Controller
{
    public function __construct(

        protected BranchService $branchService
    ) {
    }

    public function index()
    {
        $branches = $this->branchService->index();

        return view('admin.branches.index', compact('branches'));
    }

    public function create()
    {
        return view('admin.branches.create');
    }

    public function store(BranchRequest $request)
    {
        $this->branchService->store($request);

        return redirect()->route('branches.index');
    }

    public function edit($id)
    {
        $branch = $this->branchService->edit($id);

        return view('admin.branches.edit',
                    compact(['branch'])
        );
    }

    public function update(BranchUppdateRequest $request, $id)
    {
        $this->branchService->update($request, $id);

        return redirect()->route('branches.index');
    }

    public function destroy($id)
    {
        $this->branchService->destroy($id);

        return redirect()->route('branches.index');
    }
}