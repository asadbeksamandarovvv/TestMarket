@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <h1 class="d-inline">Бренд</h1>
                <a href="{{ route('brands.create') }}" class="btn btn-primary float-right">
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
                                        <th>Действие</th>
                                        <th>...</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($brandes as $brand)
                                        <tr>

                                            <td>{{ $brand->id }}</td>
                                            <td>{{ $brand->name }}</td>
                                            <td>
                                                <div class="form-group">
                                                    <span class="badge {{ $brand->is_active ? 'badge-success' : 'badge-danger' }}">
                                                        {{ $brand->is_active ? 'Активный' : 'Не активен' }}
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{ route('brands.edit', ['brand' => $brand->id]) }}">
                                                    <button class="btn btn-outline-primary">
                                                        <i class="fa fa-pencil"></i>
                                                    </button>
                                                </a>
                                                <form action="{{ route('brands.destroy', ['brand' => $brand->id]) }}"
                                                      class="d-inline"
                                                      method="POST">
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
