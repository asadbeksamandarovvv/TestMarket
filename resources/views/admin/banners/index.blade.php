@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <h1 class="d-inline">Banner</h1>
                <a href="{{ route('banners.create') }}" class="btn btn-primary float-right">
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
                                        <th>Заголовок</th>
                                        <th>Описание</th>
                                        <th>Изображение</th>
                                        <th>...</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($banner as $banners)
                                        <tr>

                                            <td>{{ $banners->id }}</td>
                                            <td>{{ $banners->title }}</td>
                                            <td>{{ $banners->description }}</td>
                                            <td>
                                                <img src="{{ asset( $banners->image?->path_original) }}"
                                                     alt="Product Image" class="img-thumbnail" width="120px">
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <span class="badge {{ $banners->is_active ? 'badge-success' : 'badge-danger' }}">
                                                        {{ $banners->is_active ? 'Активный' : 'Не активен' }}
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{ route('banners.edit', ['banner' => $banners->id]) }}">
                                                    <button class="btn btn-outline-primary">
                                                        <i class="fa fa-pencil"></i>
                                                    </button>
                                                </a>
                                                <form action="{{ route('banners.destroy', ['banner' => $banners->id])
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
