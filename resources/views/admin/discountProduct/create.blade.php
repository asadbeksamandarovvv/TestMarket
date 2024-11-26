@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <h1 class="d-inline">Создать скидку</h1>
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

                                <form action="{{ route('discount_products.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group">
                                        <label for="product_id">Выберите продукт</label>
                                        <select name="product_id" id="product_id" class="form-control">
                                            <option value="">Выберите продукт</option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
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
                                        <input type="number" name="discount_price" id="discount_price" class="form-control" placeholder="Введите скидочную цену" value="{{ old('discount_price') }}">
                                        @error('discount_price')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="percentage">Процент</label>
                                        <input type="number" class="form-control" name="percentage" id="percentage" placeholder="Введите процент" value="{{ old('percentage') }}">
                                        @error('percentage')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <!-- Start Date -->
                                    <div class="form-group">
                                        <label for="start_date">Дата начала</label>
                                        <input type="date" class="form-control" name="start_date" id="start_date" value="{{ old('start_date') }}">
                                        @error('start_date')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <!-- End Date -->
                                    <div class="form-group">
                                        <label for="end_date">Дата окончания</label>
                                        <input type="date" class="form-control" name="end_date" id="end_date" value="{{ old('end_date') }}">
                                        @error('end_date')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary">Создать скидку</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
