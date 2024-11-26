<?php

namespace App\Http\Controllers\Api;

use App\Data\LikeProductData;
use App\Data\ProductFilterData;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Services\ProductService;

class ProductController extends Controller
{
    public function __construct(
        protected ProductService $service
    ) {
    }

    public function index(ProductFilterData $filterData)
    {
        $filterData->is_active = true;

        return $this->successResponse(ProductResource::collection($this->service->index($filterData)));
    }

    public function like(LikeProductData $data)
    {
        $this->service->like($data);

        return $this->successResponse();
    }
}
