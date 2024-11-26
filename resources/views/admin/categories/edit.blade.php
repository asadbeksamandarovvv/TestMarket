@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <h1 class="d-inline">Редактирование Категория</h1>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                @if($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form action="{{ route('categories.update', ['category' => $category->id]) }}"
                                      method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="name">Имя</label>
                                        <input type="text" name="name" id="name" class="form-control"
                                               placeholder="Имя" value="{{ $category->name }}">
                                        @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="parent_id">Подкатегория</label>
                                        <select name="parent_id" id="parent_id" class="form-control">
                                            <option value="">Категория</option>
                                            @foreach($categories as $parentCategory)
                                                <option value="{{ $parentCategory->id }}">
                                                    {{ $parentCategory->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Изображение</label>
                                        <input type="file" class="form-control" name="image" id="image">
                                        @error('image')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        @if($category->image)
                                            <div class="mt-2">
                                                <strong>Изображение:</strong>
                                                <img src="{{ asset( $category->image->path_original) }}" alt="image"
                                                     class="img-thumbnail" width="100">
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="status-toggle">Активировать</label>
                                        <input type="hidden" name="is_active" value="0">
                                        <label class="switch">
                                            <input type="checkbox" id="status-toggle" name="is_active"
                                                   @checked($category->is_active) value="1">
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
