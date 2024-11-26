<?php

namespace App\Http\Controllers\Api;

use App\Data\CategoryFilterData;
use App\Data\SubCategoryFilterData;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    public function __construct(
        protected CategoryService $service
    ) {
    }

    public function index(CategoryFilterData $filterData)
    {
        $filterData->is_active = true;

        return $this->successResponse(CategoryResource::collection($this->service->index($filterData)));
    }

    public function sub_categories(SubCategoryFilterData $filterData)
    {
        return $this->successResponse(CategoryResource::collection($this->service->subCategories($filterData)));
    }
}
