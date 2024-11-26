<?php

namespace App\Services;
use App\Http\Requests\BranchRequest;
use App\Http\Requests\BranchUppdateRequest;
use App\Models\Branch;

class BranchService
{
    public function index()
    {
        return Branch::query()
            ->paginate(10);
    }
    public function store(BranchRequest $request)
    {
        return Branch::query()
            ->create($request->validated());
    }

    public function edit($id)
    {
        return Branch::findOrFail($id);
    }

    public function update(branchUppdateRequest $request, $id)
    {
        return Branch::query()
            ->findOrFail($id)
            ->update($request->validated());
    }

    public function destroy($id)
    {
        return Branch::query()
            ->findOrFail($id)
            ->delete();
    }
}
