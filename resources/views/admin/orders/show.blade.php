@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <h1 class="d-inline">Заказы</h1>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <section class="content-header">
                                    <div class="container-fluid">
                                        <h1>Детали заказа №{{ $order->id }}</h1>
                                    </div>
                                </section>
                                <section class="content">
                                    <div class="container-fluid">
                                        <div class="card">
                                            <div class="card-body">
                                                <h3>Информация о заказе:</h3>
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th>Статус</th>
                                                        <td>{{ $order->status }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Общая стоимость</th>
                                                        <td>{{ $order->total_price }} UZS</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Комментарий</th>
                                                        <td>{{ $order->comment }}</td>
                                                    </tr>
                                                </table>

                                                <h3>Продукты в заказе:</h3>
                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>Название продукта</th>
                                                        <th>Количество</th>
                                                        <th>Цена</th>
                                                        <th>Общая стоимость</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($order->orderProducts as $orderProduct)
                                                        <tr>
                                                            <td>{{ $orderProduct->product->name }}</td>
                                                            <td>{{ $orderProduct->quantity }}</td>
                                                            <td>{{ $orderProduct->price }} UZS</td>
                                                            <td>{{ $orderProduct->quantity * $orderProduct->price }} UZS</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
