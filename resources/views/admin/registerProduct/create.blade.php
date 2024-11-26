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
                            <form action="{{ route('register_products.store') }}" method="POST">
                                @csrf

                                <!-- Mahsulotni tanlash -->
                                <div class="mb-3">
                                    <label for="product_id" class="form-label">Выберите продукт</label>
                                    <select name="product_id" id="product_id"
                                            class="form-control @error('product_id') is-invalid @enderror">
                                        <option value="">Выберите продукт</option>
                                        @foreach($products as $product)
                                            <option
                                                value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                                {{ $product->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('product_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="quantity" class="form-label">Количество</label>
                                    <input type="number" name="quantity" id="quantity"
                                           class="form-control @error('quantity') is-invalid @enderror"
                                           value="{{ old('quantity') }}">
                                    @error('quantity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="price" class="form-label">Цена</label>
                                    <input type="number" name="price" id="price"
                                           class="form-control @error('price') is-invalid @enderror"
                                           value="{{ old('price') }}" step="0.01">
                                    @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="selling_price" class="form-label">Цена продажи</label>
                                    <input type="number" name="selling_price" id="selling_price"
                                           class="form-control @error('selling_price') is-invalid @enderror"
                                           value="{{ old('selling_price') }}" step="0.01">
                                    @error('selling_price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Создавать</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
