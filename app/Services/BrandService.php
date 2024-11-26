<?php

namespace App\Services;
use App\Http\Requests\BrandRequest;
use App\Http\Requests\BrandUpdateRequest;
use App\Models\Brand;

class BrandService
{
    public function index()
    {
        return Brand::query()
            ->orderBy('id')
            ->paginate(10);
    }
    public function store(BrandRequest $request)
    {
        return Brand::query()
            ->create($request->validated());
    }

    public function edit($id)
    {
        return Brand::findOrFail($id);
    }

    public function update(BrandUpdateRequest $request, $id)
    {
        return Brand::query()
            ->findOrFail($id)
            ->update($request->validated());
    }

    public function destroy($id)
    {
        return Brand::query()
            ->findOrFail($id)
            ->delete();
    }
}
