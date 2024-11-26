@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <h1 class="d-inline">Редактирование баннера</h1>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form action="{{ route('banners.update', ['banner' => $banners->id]) }}"
                                      method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')
                                    <div class="form-group">
                                        <label for="name">Заголовок</label>
                                        <input type="text" name="title" id="title" class="form-control"
                                               placeholder="Заголовок" value="{{ $banners->title }}">
                                        @error('title')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Описание</label>
                                        <input type="text" name="description" id="description" class="form-control"
                                               placeholder="Описание" value="{{ $banners->description }}">
                                        @error('description')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Изображение</label>
                                        <input type="file" class="form-control" name="image" id="image">
                                        @error('image')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        @if ($banners->image)
                                            <div class="mt-2">
                                                <strong>Текущее изображение:</strong><br>
                                                <img src="{{ asset( $banners->image->path_original) }}" alt="Изображение баннера" class="img-thumbnail" width="100">
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="status-toggle">Активировать</label>
                                        <input type="hidden" name="is_active" value="0">
                                        <label class="switch">
                                            <input type="checkbox" id="status-toggle" name="is_active"
                                                   @checked($banners->is_active) value="1">
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
