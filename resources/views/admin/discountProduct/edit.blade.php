@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <h1 class="d-inline">Редактирование продукта</h1>
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

                                <form action="{{ route('discount_products.update', ['discount_product' => $discountProduct->id]) }}"
                                      method="post"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="product_id">Название продукта</label>
                                        <select name="product_id" id="product_id" class="form-control">
                                            <option value="" disabled selected>Выберите продукт</option>
                                            @foreach($products as $product)
                                                <option value="{{ $product->id }}"
                                                    {{ old('product_id', $discountProduct->product_id) == $product->id ? 'selected' : '' }}>
                                                    {{ $product->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('product_id')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="discount_price">Цена со скидкой</label>
                                        <input type="number" name="discount_price" id="discount_price" class="form-control"
                                               value="{{ old('discount_price', $discountProduct->discount_price) }}" placeholder="Введите скидочную цену">
                                        @error('discount_price')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="percentage">Процент</label>
                                        <input type="number" class="form-control" name="percentage" id="percentage"
                                               value="{{ old('percentage', $discountProduct->percentage) }}" placeholder="percentage">
                                        @error('percentage')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="start_date">Дата начала</label>
                                        <input type="date" class="form-control" name="start_date" id="start_date"
                                               value="{{ old('start_date', optional($discountProduct->start_date)->format('Y-m-d')) }}">
                                        @error('start_date')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="end_date">Дата окончания</label>
                                        <input type="date" class="form-control" name="end_date" id="end_date"
                                               value="{{ old('end_date', optional($discountProduct->end_date)->format('Y-m-d')) }}">
                                        @error('end_date')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="status-toggle">Активировать</label>
                                        <input type="hidden" name="is_active" value="0">
                                        <label class="switch">
                                            <input type="checkbox" id="status-toggle" name="is_active"
                                                   @checked(old('is_active', $discountProduct->is_active)) value="1">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>

                                    <button type="submit" class="btn btn-primary" aria-label="Создать продукт">
                                        Сохранить
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

