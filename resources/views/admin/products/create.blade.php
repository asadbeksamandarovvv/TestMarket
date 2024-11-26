@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <h1 class="d-inline">Продукт создать</h1>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="category_id">Категория </label>
                                    <select name="category_id" id="category_id" class="form-control"
                                            onchange="fetchSubCategories()">
                                        <option value="">Select a category</option>
                                        @foreach($categories as $category)
                                            @if(is_null($category->parent_id))
                                                <option
                                                    value="{{ $category->id }}" {{ old('parent_id') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group" id="subCategoryDiv" style="display:none;">
                                    <label for="sub_category_id">Subkategoriya</label>
                                    <select name="sub_category_id" id="sub_category_id" class="form-control">
                                        <option value="">Select subcategory...</option>
                                    </select>
                                </div>

                                <div class="form-group" id="subCategoryDiv" style="display:none;">
                                    <label for="parent_id">Subkategoriya (Subkategoriya tanlash)</label>
                                    <select name="parent_id" id="parent_id" class="form-control">
                                        <option value="">Select subcategory...</option>
                                        @foreach($categories as $category)
                                            @if(!is_null($category->parent_id))
                                                <option
                                                    value="{{ $category->id }}" {{ old('parent_id') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="brand_id">Бренд</label>
                                    <select name="brand_id" id="brand_id" class="form-control">
                                        <option value="">Select a brand</option>
                                        @foreach($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="name">Название продукта</label>
                                    <input type="text" name="name" id="name" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="name_ru">Название РУ</label>
                                    <input type="text" name="name_ru" id="name_ru" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="description">Описание</label>
                                    <input type="text" name="description" id="description" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="description_ru">Описание_ru</label>
                                    <input type="text" name="description_ru" id="description_ru" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="image">Изображение</label>
                                    <input type="file" name="image" id="image" class="form-control">
                                </div>
                                <hr style="height: 3px; background-color: black; border: none;">

                                <div class="form-group d-flex justify-content-between">
                                    <div style="flex: 1; margin-right: 10px;">
                                        <label for="price">Цена</label>
                                        <input type="text" name="price" id="price" class="form-control">
                                    </div>
                                    <div style="flex: 1; margin-right: 10px;">
                                        <label for="selling_price">Цена продажи</label>
                                        <input type="text" class="form-control" name="selling_price" id="selling_price">
                                    </div>
                                    <div style="flex: 1;">
                                        <label for="quantity">Количество</label>
                                        <input type="number" class="form-control" name="quantity" id="quantity">
                                    </div>
                                </div>

                                <p class="text-muted mt-2">Заполнив эти строки, данные будут сохранены в склад.</p>

                                <button type="submit" class="btn btn-primary">Создать продукт</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
