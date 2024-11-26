@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <h1 class="d-inline">Продукты</h1>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="clients" class="table table-bordered table-hover table-sm">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Имя</th>
                                        <th>Категория</th>
                                        <th>Бренд</th>
                                        <th>Цена</th>
                                        <th>Цена продажи</th>
                                        <th>Кол-во</th>
                                        <th>Изображение</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $product)
                                        <tr>
                                            <td>{{ $product->id }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product?->category->name }}</td>
                                            <td>{{ $product?->brand->name }}</td>
                                            <td>{{ $product->price }}</td>
                                            <td>{{ $product->selling_price }}</td>
                                            <td>{{ $product->quantity }}</td>
                                            <td>
                                                <img src="{{ asset( $product->image?->path_original) }}"
                                                     alt="Product Image" class="img-thumbnail" width="120px">
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
