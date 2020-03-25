@extends(config('theme.user.user-app'))

@section('title','忘記-密碼')


{{--清空--}}
@section('app-content','忘記密碼')

@section('content-header')
    <body class="hold-transition theme-yellow bg-img" data-overlay="3">
    <div class="auth-2-outer row align-items-center h-p100 m-0">
        <div class="auth-2">
            <div class="auth-logo font-size-30">
                <a href="/" class="text-dark">主 頁</a>
            </div>
            <!-- /.login-logo -->
            <div class="auth-body">
                <p class="auth-msg text-black-50">重置密碼</p>
                @if (session('status'))
                    <div class="alert alert-success text-center" role="alert">
                        {{ __('密碼重置郵件已經發送至您的指定信箱!') }}
                    </div>
                @endif

                <form action="{{ route('password.email') }}" method="post" class="form-element">
                    @csrf

                    {{--驗證碼--}}
                    <div class="form-group has-feedback">
                        <input id="email" type="email" class="form-control" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                        <span class="ion ion-locked form-control-feedback text-dark"></span>
                    </div>
                    @if ($errors->has('captcha'))
                        <span class="text-danger text-right" role="alert">
                            <strong>{{ $errors->first('captcha') }}</strong>
                        </span>
                    @endif

                    <div class="row">
                        <div class="col-12 text-center pt-30">
                            <button type="submit" class="btn btn my-20 btn-success">重置密碼</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
@stop





