<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DiscountProductRequest;
use App\Http\Requests\DiscountUpdateProductRequest;
use App\Models\Product;
use App\Services\DiscountProductService;

class DiscountProductController extends Controller
{
    public function __construct(
        protected DiscountProductService $service
    ) {
    }

    public function index()
    {
        $discount = $this->service->index();

        return view('admin.discountProduct.index',
                    compact('discount'));
    }

    public function create()
    {
        $products = Product::all();

        return view('admin.discountProduct.create',
                    compact('products'));
    }

    public function store(DiscountProductRequest $request)
    {
        $this->service->store($request);

        return redirect()->route('discount_products.index');
    }

    public function edit($id)
    {
        $discountProduct = $this->service->edit($id);
        $products = Product::all();
        return view('admin.discountProduct.edit',
                    compact(['discountProduct', 'products'])
        );
    }

    public function update(DiscountUpdateProductRequest $request, $id)
    {
        $this->service->update($request, $id);

        return redirect()->route('discount_products.index');
    }

    public function destroy($id)
    {
        $this->service->destroy($id);

        return redirect()->route('discount_products.index');
    }
}
