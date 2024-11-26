@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <h1 class="d-inline">Тариф создать</h1>
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
                            <form action="{{ route('tariff.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Имя</label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Имя"
                                           required>
                                    @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="price">Цена</label>
                                    <input type="text" name="price" id="price" class="form-control"
                                           placeholder="Цена">
                                    @error('price')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="delivery_time">Срок поставки</label>
                                    <input type="text" name="delivery_time" id="delivery_time" class="form-control"
                                           placeholder="delivery_time">
                                    @error('delivery_time')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="free_min_total_price">Минимальная сумма</label>
                                    <input type="number" name="free_min_total_price" id="free_min_total_price"
                                           class="form-control" >
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
