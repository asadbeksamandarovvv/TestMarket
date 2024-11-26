<?php

namespace App\Services;

use App\Data\LikeProductData;
use App\Data\ProductData;
use App\Data\ProductFilterData;
use App\Data\RegisterProductData;
use App\Enums\ActionTypeEnum;
use App\Events\AttachmentDestroyEvent;
use App\Events\AttachmentEvent;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\LikedProduct;
use App\Models\Product;
use App\Models\RegisterProduct;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    public function __construct(
        protected RegisterProductService $registerProductService
    ) {
    }

    public function index(ProductFilterData $filterData)
    {
        return Product::query()
            ->when($filterData->is_active, function ($query) use ($filterData) {
                $query->where('is_active', $filterData->is_active);
            })
            ->when($filterData->category_id, function ($query) use ($filterData) {
                $query->where('category_id', $filterData->category_id);
            })
            ->when($filterData->liked, function ($query) {
                $query->whereHas('like', function ($query) {
                    $query->where('user_id', auth()->id());
                });
            })
            ->when($filterData->discount, function ($query) {
                $query->whereHas('discount')
                    ->with('discount');
            })
            ->when($filterData->search, function ($query) use ($filterData) {
                $query->where('name', 'ilike', "%$filterData->search%")
                    ->orWhere('name_ru', 'ilike', "%$filterData->search%");
            })
            ->addSelect([
                            'liked' => DB::table('liked_product')
                                ->select(DB::raw('true'))
                                ->whereColumn('liked_product.product_id', 'products.id')
                                ->where('liked_product.user_id', auth()->id())
                                ->limit(1),
                        ])
            ->with([
                       'registerProducts',
                       'category',
                       'brand',
                       'image',
                       'parent',
                   ])
            ->orderBy('id')
        ->get();
    }

    public function store(ProductData $data)
    {
        $product = Product::query()
            ->create([
                         'name'           => $data->name,
                         'name_ru'        => $data->name_ru,
                         'description'    => $data->description,
                         'description_ru' => $data->description_ru,
                         'category_id'    => $data->category_id,
                         'brand_id'       => $data->brand_id,
                         'price'          => $data->price,
                         'quantity'       => $data->quantity,
                         'selling_price'  => $data->selling_price,
                     ]);

        if (request()->hasFile('image')) {
            event(new AttachmentEvent($data->image, $product->image()));
        }
        if ($data->quantity && $data->price && $data->selling_price) {
            $this->registerProductService->store(new RegisterProductData(
                                                     $product->id,
                                                     $data->quantity,
                                                     $data->price,
                                                     $data->selling_price,
                                                     ActionTypeEnum::INCOME
                                                 ));
        }
    }

    public function edit($id)
    {
        return Product::query()
            ->with('category', 'brand', 'image', 'parent')
            ->findOrFail($id);
    }

    public function update(ProductUpdateRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update([
                             'name'           => $request->name,
                             'name_ru'        => $request->name_ru,
                             'description'    => $request->description,
                             'description_ru' => $request->description_ru,
                             'category_id'    => $request->category_id,
                             'brand_id'       => $request->brand_id,
                             'price'          => $request->price,
                             'quantity'       => $request->quantity,
                             'selling_price'  => $request->selling_price,
                             'is_active'      => $request->is_active,
                         ]);
        if (request()->hasFile('image')) {
            if ($product->image) {
                event(new AttachmentDestroyEvent($product->image));
                $product->image()->delete();
            }
            event(new AttachmentEvent($request->image, $product->image()));
        }
    }

    public function destroy($id)
    {
        RegisterProduct::where('product_id', $id)->delete();

        return Product::query()
            ->findOrFail($id)
            ->delete();
    }

    public function like(LikeProductData $data)
    {
        $exists = DB::table('liked_product')
            ->where('product_id', $data->product_id)
            ->where('user_id', auth()->id())
            ->exists();

        if ($exists) {
            DB::table('liked_product')
                ->where('product_id', $data->product_id)
                ->where('user_id', auth()->id())
                ->delete();
        } else {
            DB::table('liked_product')
                ->insert([
                             'product_id' => $data->product_id,
                             'user_id'    => auth()->id(),
                         ]);
        }
    }
}
