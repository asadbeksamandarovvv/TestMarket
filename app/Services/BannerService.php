<?php

namespace App\Services;

use App\Data\BannerFilterData;
use App\Events\AttachmentEvent;
use App\Http\Requests\BannerRequest;
use App\Http\Requests\BannerUpdateRequest;
use App\Models\Banner;

class BannerService
{
    public function index(BannerFilterData $filterData)
    {
        return Banner::query()
            ->when($filterData->is_active, fn($query) => $query->where('is_active', $filterData->is_active))
            ->with('image')
            ->paginate(10);
    }

    public function store(BannerRequest $request)
    {
        $banner = Banner::query()
            ->create($request->validated());

        if ($request->hasFile('image')) {
            event(new AttachmentEvent(request()->image, $banner->image()));
        }
    }

    public function edit($id)
    {
        return Banner::query()->findOrFail($id);
    }

    public function update(BannerUpdateRequest $request, $id)
    {
        $banner = Banner::query()->findOrFail($id);
        $banner->update($request->validated());

        if ($request->hasFile('image')) {
            event(new AttachmentEvent($request->file('image'), $banner->image()));
        }
    }

    public function destroy($id)
    {
        return Banner::query()
            ->findOrFail($id)
            ->delete();
    }
}
