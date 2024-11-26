@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <h1 class="d-inline">Тариф</h1>
                <a href="{{ route('tariff.create') }}" class="btn btn-primary float-right">
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
                                        <th>Цена</th>
                                        <th>Срок поставки</th>
                                        <th>Минимальная сумма</th>
                                        <th>...</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($tariffs as $tarif)
                                        <tr>

                                            <td>{{ $tarif->id }}</td>
                                            <td>{{ $tarif->name }}</td>
                                            <td>{{ $tarif->price }}</td>
                                            <td>{{ $tarif->delivery_time }}</td>
                                            <td>{{ $tarif->free_min_total_price ? $tarif->free_min_total_price . ' сум' : 'Не установлена'}}</>
                                            <td>
                                                <a href="{{ route('tariff.edit', ['tariff' => $tarif->id]) }}">
                                                    <button class="btn btn-outline-primary">
                                                        <i class="fa fa-pencil"></i>
                                                    </button>
                                                </a>
                                                <form action="{{ route('tariff.destroy', ['tariff' => $tarif->id])
                                                 }}"
                                                      class="d-inline"
                                                      method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Вы уверены, что хотите удалить этот элемент?')">
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
