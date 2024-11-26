@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <h1 class="d-inline">Товары со скидкой</h1>
                <a href="{{ route('discount_products.create') }}" class="btn btn-primary float-right">
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
                                        <th>Продукты</th>
                                        <th>Цена</th>
                                        <th>Цена со скидкой</th>
                                        <th>Процент</th>
                                        <th>Дата начала</th>
                                        <th>Дата окончания</th>
                                        <th>Действие</th>
                                        <th>...</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($discount as $disc)
                                        <tr>
                                            <td>{{ $disc->id }}</td>
                                            <td>{{ $disc->product?->name }} сум</td>
                                            <td>{{ $disc->price }}</td>
                                            <td>{{ $disc->discount_price }}</td>
                                            <td>{{ $disc->percentage }}</td>
                                            <td>{{ $disc->start_date }}</td>
                                            <td>{{ $disc->end_date }}</td>
                                            <td>
                                                <div class="form-group">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" id="isActiveSwitch{{$disc->id}}" name="is_active" value="1" @checked($disc->is_active)>
                                                        <label class="custom-control-label" for="isActiveSwitch{{$disc->id}}"></label>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <a href="{{ route('discount_products.edit', ['discount_product' => $disc->id]) }}">
                                                    <button class="btn btn-outline-primary">
                                                        <i class="fa fa-pencil"></i>
                                                    </button>
                                                </a>
                                                <form
                                                    action="{{ route('discount_products.destroy', ['discount_product' => $disc->id]) }}"
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
