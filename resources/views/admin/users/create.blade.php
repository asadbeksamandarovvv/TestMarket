@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <h1 class="d-inline">Пользователь создать</h1>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="container-fluid">
                    <div class="card">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="card-body">
                            <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="branch_id">Филиал</label>
                                    <select name="branch_id" id="branch_id" class="form-control">
                                        <option value="" disabled selected>Выберите филиал (не обязательно)</option>
                                        @foreach($branches as $branch)
                                            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="full_name">Имя</label>
                                    <input type="text" name="full_name" id="full_name" class="form-control"
                                           placeholder="Имя" required>
                                    @error('full_name')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="phone_number">Телефон</label>
                                    <input type="text" name="phone_number" id="phone_number" class="form-control"
                                           placeholder="Телефон" required>
                                    @error('phone_number')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="password">Пароль</label>
                                    <input type="password" name="password" id="password" class="form-control"
                                           placeholder="Пароль" required>
                                    @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="password_confirmation">Подтвердите пароль</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                           class="form-control" placeholder="Подтвердите пароль" required>
                                    @error('password_confirmation')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="image">Изображение</label>
                                    <input type="file" name="image" id="image" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="role">Роль</label>
                                    <select name="role" id="role" class="form-control" required>
                                        <option value="">Выберите роль</option>
                                        @foreach(\App\Enums\RoleEnum::cases() as $role)
                                            <option value="{{ $role->value }}">{{ $role->name }}</option>
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
