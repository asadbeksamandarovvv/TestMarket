@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <h1 class="d-inline">Редактирование Бренд</h1>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('brands.update', ['brand' => $brand->id]) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="name">Имя</label>
                                        <input type="text" name="name" id="name" class="form-control"
                                               placeholder="Имя" value="{{ $brand->name }}">
                                        @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="status-toggle">Активировать</label>
                                        <input type="hidden" name="is_active" value="0">
                                        <label class="switch">
                                            <input type="checkbox" id="status-toggle" name="is_active"
                                                   @checked($brand->is_active) value="1">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Сохранить</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
