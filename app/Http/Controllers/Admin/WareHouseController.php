<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\ProductService;
use App\Services\WareHouseService;

class WareHouseController extends Controller
{
    public function __construct(
        protected WareHouseService $service
    ) {
    }

    public function index()
    {
        $products = $this->service->index();
        return view('admin.variables.index', compact('products'));
    }
}
