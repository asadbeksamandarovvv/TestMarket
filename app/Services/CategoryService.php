<?php

namespace App\Services;

use App\Data\CategoryFilterData;
use App\Data\SubCategoryFilterData;
use App\Events\AttachmentDestroyEvent;
use App\Events\AttachmentEvent;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategoryService
{
    public function index(CategoryFilterData $filterData)
    {
        return Category::query()
            ->when($filterData->is_active, function ($query) use ($filterData) {
                $query->where('is_active', $filterData->is_active);
            })
            ->where('parent_id', null)
            ->with([
                       'image',
                       'children.image',
                       'children.children',
                   ])
            ->when($filterData->with_products, function ($query) {
                $query->with([
                                 'children' => function ($query) {
                                     $query->with([
                                                      'products' => function ($query) {
                                                          $query->with('image')
                                                              ->addSelect([
                                                                              'liked' => DB::table('liked_product')
                                                                                  ->select(DB::raw('true'))
                                                                                  ->whereColumn('liked_product.product_id', 'products.id')
                                                                                  ->where('liked_product.user_id', auth()->id() ?? 0)
                                                                                  ->limit(1),
                                                                          ]);
                                                      },
                                                  ]);
                                 },
                             ]);
            })
            ->get();
    }

    public function subCategories(SubCategoryFilterData $filterData)
    {
        return Category::query()
            ->when($filterData->parent_id, function ($query) use ($filterData) {
                $query->where('parent_id', $filterData->parent_id);
            })
            ->when($filterData->with_products, function ($query) {
                $query->with([
                                 'products' => function ($query) {
                                     $query->with('image')
                                         ->addSelect([
                                                         'liked' => DB::table('liked_product')
                                                             ->select(DB::raw('true'))
                                                             ->whereColumn('liked_product.product_id', 'products.id')
                                                             ->where('liked_product.user_id', auth()->id() ?? 0)
                                                             ->limit(1),
                                                     ]);
                                 },
                             ]);
            })
            ->whereNotNull('parent_id')
            ->with([
                       'image',
                   ])
            ->get();
    }

    public function store(CategoryRequest $request)
    {
        $categoryData = $request->validated();

        $category = Category::create($categoryData);

        if (request()->hasFile('image')) {
            event(new AttachmentEvent(request()->image, $category->image()));
        }

        if (is_null($category->parent_id)) {
            $category->parent_id = null;
        }
        $category->save();

        return redirect()->route('categories.index');
    }


    public function edit($id)
    {
        return Category::query()
            ->with('image')
            ->findOrFail($id);
    }

    public function update(CategoryUpdateRequest $request, $id)
    {
        $category = Category::query()
            ->findOrFail($id);
        $category->update($request->validated());

        if (request()->hasFile('image')) {
            if ($category->image) {
                event(new AttachmentDestroyEvent($category->image));
                $category->image()->delete();
            }
            event(new AttachmentEvent($request->image, $category->image()));
        }
    }

    public function destroy($id)
    {
        return Category::query()
            ->findOrFail($id)
            ->delete();
    }
}
