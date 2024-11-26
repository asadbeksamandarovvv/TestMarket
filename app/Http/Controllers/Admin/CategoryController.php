<?php

namespace App\Http\Controllers\Admin;

use App\Data\CategoryFilterData;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    public function __construct(
        protected CategoryService $service
    ) {
    }

    public function index(CategoryFilterData $filterData)
    {
        $cats = Category::query()
            ->orderBy('id')
            ->get();

        return view('admin.categories.index',
                    compact('cats'));
    }

    public function create()
    {
        $categories = Category::whereNull('parent_id')->get();

        return view('admin.categories.create',
                    compact('categories'));
    }

    public function store(CategoryRequest $request)
    {
        $this->service->store($request);

        return redirect()->route('categories.index');
    }

    public function edit($id)
    {
        $category   = $this->service->edit($id);
        $categories = $this->service->index(new CategoryFilterData(0));

        return view('admin.categories.edit',
                    compact(['categories', 'category'])
        );
    }

    public function update(CategoryUpdateRequest $request, $id)
    {
        $this->service->update($request, $id);

        return redirect()->route('categories.index');
    }

    public function destroy($id)
    {
        $this->service->destroy($id);

        return redirect()->route('categories.index');
    }

    public function subCategories($categoryId)
    {
        $subCategories = Category::where('parent_id', $categoryId)
                                    ->get();

        return response()->json($subCategories);
    }
}

