@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <h1 class="d-inline">Продукты</h1>
                <a href="{{ route('products.create') }}" class="btn btn-primary float-right">
                    Добавить
                </a>
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
                                        <th>Название РУ</th>
                                        <th>Категория</th>
                                        <th>Бренд</th>
                                        <th>Цена</th>
                                        <th>Описание</th>
                                        <th>Описание РУ</th>
                                        <th>Цена продажи</th>
                                        <th>Кол-во</th>
                                        <th>Изображение</th>
                                        <th>Действие</th>
                                        <th>...</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                    @foreach($products as $product)
                                        <tr>
                                            <td>{{ $product->id }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->name_ru }} </td>
                                            <td>{{ $product->category->name }}</td>
                                            <td>{{ $product->brand?->name }}</td>
                                            <td>{{ $product->price }} сум</td>
                                            <td>{{ $product->description }}</td>
                                            <td>{{ $product->description_ru }}</td>
                                            <td>{{ $product->selling_price }} сум</td>
                                            <td>{{ $product->quantity }}</td>
                                            <td>
                                                <img src="{{ asset( $product->image?->path_original) }}"
                                                     alt="Product Image" class="img-thumbnail" width="120px">
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <span class="badge {{ $product->is_active ? 'badge-success' : 'badge-danger' }}">
                                                        {{ $product->is_active ? 'Активный' : 'Не активен' }}
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{ route('products.edit', ['product' => $product->id]) }}">
                                                    <button class="btn btn-outline-primary">
                                                        <i class="fa fa-pencil"></i>
                                                    </button>
                                                </a>
                                                <form
                                                    action="{{ route('products.destroy', ['product' => $product->id]) }}"
                                                    class="d-inline" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-danger"
                                                            onclick="return confirm('Вы уверены, что хотите удалить этот элемент?')">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
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
