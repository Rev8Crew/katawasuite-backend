@extends('authorization::auth')

@section('content')
    <div class="card fat">
                        <div class="card-body">
                            <h4 class="card-title">Вход</h4>
                            <div class="alert alert-warning">Кажется, мы забыли, кто вы. Напомните нам, пожалуйста.</div>
                            <form method="POST" class="my-login-validation" novalidate="" action="{{ route('auth.app-login') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="email">E-Mail Адресс</label>
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required
                                           autofocus>
                                    <div class="invalid-feedback">
                                        Email is invalid
                                    </div>
                                    @if ($errors->has('email'))
                                        <div class="invalid-feedback" style="display: initial">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="password">Password
                                    </label>
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required
                                           data-eye>
                                    <div class="invalid-feedback">
                                        Password is required
                                    </div>

                                    @if ($errors->has('password'))
                                        <div class="invalid-feedback" style="display: initial">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <div class="custom-checkbox custom-control">
                                        <input type="checkbox" name="remember" id="remember"
                                               class="custom-control-input" {{ old('remember') ? 'checked' : '' }}>
                                        <label for="remember" class="custom-control-label">Больше не забывать кто я!</label>
                                    </div>
                                </div>

                                <div class="form-group m-0">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        Войти
                                    </button>
                                </div>
                                <div class="mt-4 text-center">
                                    После авторизации вам, возможно, понадобится заново выбрать игру и нажать <strong>Играть онлайн</strong>
                                </div>
                            </form>
                        </div>
                    </div>
@endsection
