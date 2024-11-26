@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <h1 class="d-inline">Партии продукта</h1>
                <a href="{{ route('register_products.create') }}" class="btn btn-primary float-right">
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
                                        <th>Название продукта</th>
                                        <th>Количество</th>
                                        <th>Цена</th>
                                        <th>Цена продажи</th>
                                        <th>Тип действия</th>
                                        <th>Время создания</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                    @foreach($regProduct as $registerProduct)
                                        <tr>
                                            <td>{{ $registerProduct->id }}</td>
                                            <td>{{ $registerProduct->product->name }}</td>
                                            <td>{{ $registerProduct->quantity }}</td>
                                            <td>{{ $registerProduct->price }}</td>
                                            <td>{{ $registerProduct->selling_price }}</td>
                                            <td>
                                                @if($registerProduct->action_type ==
                                                \App\Enums\ActionTypeEnum::INCOME->value)
                                                    <span class="badge bg-success">Приход</span>
                                                @endif
                                                @if($registerProduct->action_type ==
                                                \App\Enums\ActionTypeEnum::OUTCOME->value)
                                                    <span class="badge bg-danger">Расход</span>
                                                @endif
                                            </td>
                                            <td>{{ $registerProduct->created_at }}</td>
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
