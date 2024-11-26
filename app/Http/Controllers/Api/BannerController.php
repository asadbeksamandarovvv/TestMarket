<?php

namespace App\Http\Controllers\Api;

use App\Data\BannerFilterData;
use App\Http\Controllers\Controller;
use App\Http\Resources\BannerResource;
use App\Http\Resources\BrandResource;
use App\Services\BannerService;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function __construct(
        protected BannerService $service
    ) {
    }

    public function index()
    {
        return $this->successResponse(BannerResource::collection($this->service->index(new BannerFilterData(
                                                                                           is_active: true
                                                                                       ))));
    }
}
