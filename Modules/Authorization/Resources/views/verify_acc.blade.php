@extends('authorization::auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Подтверждение email адреса</div>

                <div class="card-body">
                        <div class="alert alert-success" role="alert">
                            {{ "Ваш email адрес успешно подтвержден" }}<br>
                            Для входа перейдите по ссылке <a href="{{ asset('/') }}"> Тык</a>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
