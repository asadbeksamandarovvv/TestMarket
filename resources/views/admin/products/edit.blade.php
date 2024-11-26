@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <h1 class="d-inline">Редактирование продукт</h1>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
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

                            <form action="{{ route('products.update', ['product' => $product->id]) }}" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="category_id">Категория</label>
                                    <select name="category_id" id="category_id" class="form-control" onchange="fetchSubCategories()">
                                        <option value="">Выберите категорию</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id',
                                            $product->category_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group" id="subCategoryDiv" style="{{ old('category_id', $product->category_id) ? 'display:block;' : 'display:none;' }}">
                                    <label for="sub_category_id">Subkategoriya</label>
                                    <select name="parent_id" id="sub_category_id" class="form-control">
                                        <option value="">Select subcategory...</option>
                                        @foreach($subCategories as $subCategory)
                                            <option value="{{ $subCategory->id }}"  @selected($subCategory->id ==
                                            $product->category_id) {{ old('parent_id',
                                            $product->parent_id) == $subCategory->id ? 'selected' : '' }}>
                                                {{ $subCategory->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('parent_id')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="brand_id">Бренд</label>
                                    <select name="brand_id" id="brand_id" class="form-control" >
                                        <option value="">Выберите бренд</option>
                                        @foreach($brands as $brand)
                                            <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>
                                                {{ $brand->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('brand_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="name">Название продукта</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        value="{{ old('name', $product->name) }}" placeholder="Введите название продукта" >
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="name_ru">Название РУ</label>
                                    <input type="text" name="name_ru" id="name_ru" class="form-control"
                                           value="{{ old('name_ru', $product->name_ru) }}" >
                                    @error('name_ru')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="description">Описание</label>
                                    <input type="text" name="description" id="description" class="form-control"
                                           value="{{ old('description', $product->description) }}" >
                                    @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="description_ru">Описание_ru</label>
                                    <input type="text" name="description_ru" id="description_ru" class="form-control"
                                           value="{{ old('description_ru', $product->description_ru) }}" >
                                    @error('description_ru')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="price">Цена</label>
                                    <input type="number" name="price" id="price" class="form-control"
                                        value="{{ old('price', $product->price) }}" placeholder="Введите цену" >
                                    @error('price')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="selling_price">Цена продажи</label>
                                    <input type="number" class="form-control" name="selling_price" id="selling_price"
                                           value="{{ old('selling_price', $product->selling_price) }}" placeholder="Введите цену продажи" >
                                    @error('selling_price')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="image">Изображение</label>
                                    <input type="file" class="form-control" name="image" id="image">
                                    @error('image')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    @if ($product->image)
                                        <div class="mt-2">
                                            <strong>Изображение:</strong><br>
                                            <img src="{{ asset( $product->image->path_original) }}" alt="Product Image" class="img-thumbnail" width="100">
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="status-toggle">Активировать</label>
                                    <input type="hidden" name="is_active" value="0">
                                    <label class="switch">
                                        <input type="checkbox" id="status-toggle" name="is_active"
                                               @checked($product->is_active) value="1">
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-primary" aria-label="Создать продукт">Сохранят</button>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
