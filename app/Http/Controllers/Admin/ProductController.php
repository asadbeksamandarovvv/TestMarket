<?php

namespace App\Http\Controllers\Admin;

use App\Data\ProductData;
use App\Data\ProductFilterData;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Services\ProductService;
use App\Models\Category;
use App\Models\Brand;


class ProductController extends Controller
{
    public function __construct(
        protected ProductService $service
    ) {
    }

    public function index()
    {
        $products = $this->service->index(new ProductFilterData());

        return view('admin.products.index',
                    compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $brands     = Brand::all();

        return view('admin.products.create',
                    compact('categories', 'brands'));
    }

    public function store(ProductRequest $request)
    {
        $this->service->store(new ProductData(
                                  $request->name,
                                  $request->name_ru,
                                  $request->description,
                                  $request->description_ru,
                                  $request->price,
                                  $request->selling_price,
                                  $request->category_id,
                                  $request->brand_id,
                                  $request->quantity,
                                  $request->image,
                              ));

        return redirect()->route('products.index');
    }

    public function edit($id)
    {
        $product    = $this->service->edit($id);
        $categories = Category::all();
        $brands     = Brand::all();
        $subCategories = Category::whereNotNull('parent_id')->get();

        return view('admin.products.edit',
                    compact(['product', 'categories', 'brands' , 'subCategories',])
        );
    }

    public function update(ProductUpdateRequest $request, $id)
    {
        $this->service->update($request, $id);

        return redirect()->route('products.index');
    }

    public function destroy($id)
    {
        $this->service->destroy($id);

        return redirect()->route('products.index');
    }
}
