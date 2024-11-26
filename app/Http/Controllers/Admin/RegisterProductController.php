<?php

namespace App\Http\Controllers\Admin;

use App\Data\RegisterProductData;
use App\Enums\ActionTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterProductRequest;
use App\Models\Product;
use App\Services\ProductService;
use App\Services\RegisterProductService;

class RegisterProductController extends Controller
{
    public function __construct(
        protected RegisterProductService $service,
        protected ProductService $productService,
    ) {
    }

    public function index()
    {
        $regProduct = $this->service->index();

        return view('admin.registerProduct.index',
                    compact('regProduct'));
    }

    public function create()
    {
        $products = Product::all();

        return view('admin.registerProduct.create',
                    compact('products'));
    }

    public function store(RegisterProductRequest $request)
    {
        $this->service->store(new RegisterProductData(
                                  $request->product_id,
                                  $request->quantity,
                                  $request->price,
                                  $request->selling_price,
                                  ActionTypeEnum::INCOME
                              ));

        return redirect()->route('register_products.index');
    }
}
