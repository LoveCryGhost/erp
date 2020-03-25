@extends(config('theme.member.member-app'))

@section('title','重置密碼')


{{--清空--}}
@section('app-content','')

@section('content-header')
    <body class="hold-transition theme-yellow bg-img" style="background-image: url({{asset('theme/cryptoadmin/images/auth-bg/bg.jpg')}})" data-overlay="3">

    <div class="auth-2-outer row align-items-center h-p100 m-0">
        <div class="auth-2 bg-primary">
            <div class="auth-logo font-size-30">
                <a href="/" class="text-dark"><b>Member - 重置密碼</b></a>
            </div>
            <!-- /.login-logo -->
            <div class="auth-body">

                <form action="{{route('member.password.update')}}" method="post" class="form-element">
                    @csrf
                    <input type="hidden" name="token" value="{{$token}}">

                    <div class="form-group has-feedback">
                        <input type="email" class="form-control" name="email" placeholder="Email" value="{{ $email ?? old('email') }}">
                        <span class="ion ion-email form-control-feedback text-dark"></span>
                    </div>

                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                        <span class="ion ion-locked form-control-feedback text-dark"></span>
                    </div>

                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" name="password_confirmation" placeholder="Retype password">
                        <span class="ion ion-log-in form-control-feedback text-dark"></span>
                    </div>

                    {{--驗證碼--}}
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-8">
                                <input id="captcha" class="form-control{{ $errors->has('captcha') ? ' is-invalid' : '' }}" name="captcha" placeholder="驗證碼">
                            </div>
                            <div class="col-md-4">
                                <span class="form-control-feedback text-dark">
                                    <img class="thumbnail captcha mt mb-2" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">
                                </span>
                            </div>
                        </div>
                    </div>
                    @if ($errors->has('captcha'))
                        <span class="text-danger text-right" role="alert">
                            <strong>{{ $errors->first('captcha') }}</strong>
                        </span>
                    @endif

                    {{--註冊提交按鈕--}}
                    <div class="row">
                        <div class="col-12 text-center">
                            <button type="submit" class="btn my-20 btn-success">重置密碼</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
        </div>

    </div>
    </body>
@endsection
