<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Http\Requests\BrandUpdateRequest;
use App\Services\BrandService;
use App\Models\Brand;

class BrandController extends Controller
{
    public function __construct(

        protected BrandService $brandService
    ) {
    }

    public function index()
    {
        $brandes = $this->brandService->index();

        return view('admin.brands.index', compact('brandes'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(BrandRequest $request)
    {
        $this->brandService->store($request);

        return redirect()->route('brands.index');
    }

    public function edit($id)
    {
        $brand = $this->brandService->edit($id);

        return view('admin.brands.edit',
                    compact(['brand'])
        );
    }

    public function update(BrandUpdateRequest $request, $id)
    {
        $this->brandService->update($request, $id);

        return redirect()->route('brands.index');
    }

    public function destroy($id)
    {
        $this->brandService->destroy($id);

        return redirect()->route('brands.index');
    }
}
