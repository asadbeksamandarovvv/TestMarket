<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderProduct;
use App\Services\OrderProductsService;
use App\Services\OrderService;

class OrderProductController extends Controller
{
    public function __construct(

        protected OrderService $orderService,
        protected OrderProductsService $orderProductService
    ) {}
    public function index()
    {
        $orderProduct = $this->orderProductService->index();
        return view('admin.order_Product.index', compact('orderProduct'));
    }
}
