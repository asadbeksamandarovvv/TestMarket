@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <h1 class="d-inline">Пользователи</h1>
                <a href="{{ route('users.create') }}" class="btn btn-primary float-right">
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
                                <form action="{{ route('users.index') }}" method="get" class="form-inline">
                                    <select name="role_id" id="role_id" class="form-control select2">
                                        <option value="" selected>Выберите роль</option>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}"
                                                {{ request('role_id') == $role->id ? 'selected' : '' }}>
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <button class="btn btn-primary">Фильтр</button>
                                </form>
                                <table id="clients" class="table table-bordered table-hover table-sm">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Имя</th>
                                            <th>Телефон</th>
                                            <th>Филиал</th>
                                            <th>Роль</th>
                                            <th>Изображение</th>
                                            <th>Действия</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)
                                            <tr>
                                                <td>{{ $user->id }}</td>
                                                <td>{{ $user->full_name }}</td>
                                                <td>{{ $user->phone_number }}</td>
                                                <td>{{ $user->branch->name ?? 'Нет филиала' }}</td>
                                                <td>{{ optional($user->role->first())->name ?? 'Нет роли' }}</td>
                                                <td>
                                                    <img src="{{ asset( $user->image?->path_original) }}"
                                                         alt="Product Image" class="img-thumbnail" width="120px">
                                                </td>
                                                <td>
                                                <a href="{{ route('users.edit', ['user' => $user->id]) }}">
                                                    <button class="btn btn-outline-primary">
                                                        <i class="fa fa-pencil"></i>
                                                    </button>
                                                </a>
                                                <form action="{{ route('users.destroy', ['user' => $user->id]) }}" class="d-inline" method="POST">
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
                                {{ $users->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
