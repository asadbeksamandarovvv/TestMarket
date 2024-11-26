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
                                <table id="clients" class="table table-bordered table-hover table-sm">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Статус заказа</th>
                                        <th>Курьер</th>
                                        <th>Клиент</th>
                                        <th>Адрес</th>
                                        <th>Общая стоимость</th>
                                        <th>Квитанция</th>
                                        <th>...</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td>
                                                @switch($order->status)
                                                    @case('new')
                                                        <span class="badge badge-primary">Новый</span>
                                                        @break

                                                    @case('accepted')
                                                        <span class="badge badge-success">Принял</span>
                                                        @break

                                                    @case('delivery')
                                                        <span class="badge badge-warning">В доставке</span>
                                                        @break

                                                    @case('done')
                                                        <span class="badge badge-secondary">Сделанный</span>
                                                        @break

                                                    @case('canceled')
                                                        <span class="badge badge-danger">Отменено</span>
                                                        @break

                                                    @default
                                                        <span class="badge badge-light">Неизвестный</span>
                                                @endswitch
                                            </td>
                                            <td>{{ $order->courier?->full_name }}</td>
                                            <td>{{ $order->client?->phone_number }}</td>
                                            <td>{{ $order->address }}</td>
                                            <td>{{ $order->total_price }} UZS</td>
                                            <td>
                                                <a href="{{ route('orders.pdf', ['id' => $order->id]) }}"
                                                   target="_blank"
                                                   class="badge badge-dark">
                                                    <i class="fa fa-download"></i> Download PDF
                                                </a>
                                            </td>
                                            <td>
                                                <form action="{{ route('orders.accept', $order->id) }}"
                                                      class="d-inline"
                                                      method="POST">
                                                    @csrf
                                                    <button type="submit"
                                                            class="btn btn-success btn-sm"
                                                            onclick="return confirm('Вы уверены, что хотите принять этот заказ?')">
                                                        <i class="fa fa-check"></i>
                                                    </button>
                                                </form>

                                                <a href="{{ route('order.show', $order->id) }}">
                                                    <button class="btn btn-outline-primary btn-sm">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                </a>

                                                <!-- Cancel Order Button -->
                                                @if($order->status != 'canceled')
                                                    <form action="{{ route('orders.cancel', $order->id) }}"
                                                          class="d-inline"
                                                          method="POST">
                                                        @csrf
                                                        <button type="submit"
                                                                class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Вы уверены, что хотите отменить этот заказ?')">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                @else
                                                    <span class="badge badge-danger">Отменен</span>
                                                @endif
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
