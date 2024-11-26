<?php

namespace App\Http\Controllers\Admin;

use App\Data\BannerFilterData;
use App\Http\Controllers\Controller;
use App\Http\Requests\BannerRequest;
use App\Http\Requests\BannerUpdateRequest;
use App\Services\BannerService;

class BannerController extends Controller
{
    public function __construct(

        protected BannerService $service
    ) {
    }

    public function index()
    {
        $banner = $this->service->index(new BannerFilterData);

        return view('admin.banners.index',
                    compact('banner'));
    }

    public function create()
    {
        return view('admin.banners.create');
    }

    public function store(BannerRequest $request)
    {
        $this->service->store($request);

        return redirect()->route('banners.index');
    }

    public function edit($id)
    {
        $banners = $this->service->edit($id);

        return view('admin.banners.edit',
                    compact(['banners'])
        );
    }

    public function update(BannerUpdateRequest $request, $id)
    {
        $this->service->update($request, $id);

        return redirect()->route('banners.index');
    }

    public function destroy($id)
    {
        $this->service->destroy($id);

        return redirect()->route('banners.index');
    }
}
