<?php

namespace App\Http\Controllers\Api;

use App\Data\OrderData;
use App\Data\OrderFilterData;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Services\OrderService;

class OrderController extends Controller
{
    public function __construct(
        protected OrderService $service
    ) {
    }

    public function index(OrderFilterData $filterData)
    {
        return $this->successResponse(OrderResource::collection($this->service->index($filterData)));
    }

    public function store(OrderData $data)
    {
        return $this->successResponse(new OrderResource($this->service->create($data)));
    }
}
