{{--@extends(config('theme.member.member-app'))--}}
@extends(config('theme.member.member-app-login'))


@section('title','忘記-密碼')


{{--清空--}}
@section('app-content','忘記密碼')

@section('content-header')
    <body class="hold-transition theme-yellow bg-img" data-overlay="3">
        <div class="auth-2-outer row align-items-center h-p100 m-0">
            <div class="auth-2  bg-primary">
                <div class="auth-logo font-size-30">
                    <a href="/" class="text-dark">{{__('default.login.hompage')}}</a>
                </div>
                <!-- /.login-logo -->
                <div class="auth-body">
                    <p class="auth-msg text-black-50">Member - {{__('default.resetPassword.reset_password')}}</p>
                    @if (session('status'))
                        <div class="alert alert-success text-center" role="alert">
                            {{ __('default.resetPassword.email_has_send') }}
                        </div>
                    @endif
    
                    <form action="{{ route('member.password.email') }}" method="post" class="form-element">
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
                                <button type="submit" class="btn btn my-20 btn-success">{{__('default.resetPassword.reset_password')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
@stop