<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TariffResource;
use App\Services\TariffService;

class TariffController extends Controller
{
    public function __construct(
        protected TariffService $service
    ) {
    }

    public function index()
    {
        return $this->successResponse(TariffResource::collection($this->service->index()));
    }
}
