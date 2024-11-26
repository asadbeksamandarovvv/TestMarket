@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <h1 class="d-inline">Редактировать пользователя</h1>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="container-fluid">
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
                            <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="branch_id">Филиал</label>
                                    <select name="branch_id" id="branch_id" class="form-control">
                                        <option value="" disabled {{ is_null(old('branch_id', $user->branch_id)) ? 'selected' : '' }}>Выберите филиал (не обязательно)</option>
                                        @foreach($branches as $branch)
                                            <option value="{{ $branch->id }}" {{ old('branch_id', $user->branch_id) == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="name">Имя</label>
                                    <input type="text" name="full_name" id="name" class="form-control" placeholder="Имя" value="{{ old('full_name', $user->full_name) }}" required>
                                    @error('full_name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="phone_number">Телефон</label>
                                    <input type="text" name="phone_number" id="phone_number" class="form-control" placeholder="Телефон" value="{{ old('phone_number', $user->phone_number) }}" required>
                                    @error('phone_number')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="password">Пароль</label>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Пароль">
                                    @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="password_confirmation">Подтвердите пароль</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Подтвердите пароль">
                                    @error('password_confirmation')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="image">Изображение</label>
                                    <input type="file" class="form-control" name="image" id="image">
                                    @error('image')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    @if ($user->image)
                                        <div class="mt-2">
                                            <strong>Изображение:</strong><br>
                                            <img src="{{ asset( $user->image->path_original) }}" alt="Product Image"
                                                 class="img-thumbnail" width="100">
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="role">Роль</label>
                                    <select name="role" id="role" class="form-control" required>
                                        <option value="">Выберите роль</option>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->name }}"
                                                {{ $user->roles->first()?->name === $role->name ? 'selected' : '' }}>
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('role')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Сохранить</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
