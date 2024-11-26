<?php

namespace App\Http\Controllers\Courier;

use App\Data\OrderFilterData;
use App\Enums\OrderStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Services\OrderService;

class OrderController extends Controller
{
    public function __construct(
        private OrderService $service
    ) {
    }

    public function index()
    {
        return $this->successResponse($this->service->index(
            new OrderFilterData(
                null,
                [OrderStatusEnum::NEW],
            )
        ));
    }

    public function take($order_id)
    {
        return $this->successResponse(new OrderResource($this->service->take($order_id)));
    }
    public function done($order_id)
    {
        return $this->successResponse(new OrderResource($this->service->done($order_id)));
    }
}
