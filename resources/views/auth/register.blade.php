@extends(config('theme.user.user-app'))

@section('title','用戶-登入')


{{--清空--}}
@section('app-content','')

@section('content-header')
    <body class="hold-transition theme-yellow bg-img" style="background-image: url({{asset('theme/cryptoadmin/images/auth-bg/bg.jpg')}})" data-overlay="3">

    <div class="auth-2-outer row align-items-center h-p100 m-0">
        <div class="auth-2">
            <div class="auth-logo font-size-30">
                <a href="/" class="text-dark"><b>主 頁</b></a>
            </div>
            <!-- /.login-logo -->
            <div class="auth-body">
                <p class="auth-msg text-black-50">註冊新會員</p>

                <form action="{{route('register')}}" method="post" class="form-element">
                    @csrf
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" name="name" placeholder="Full name" value="{{old('name')}}">
                        <span class="ion ion-person form-control-feedback text-dark"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="email" class="form-control" name="email" placeholder="Email" value="{{old('email')}}">
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
                            <button type="submit" class="btn my-20 btn-success">註冊</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <div class="text-center text-dark">
                    <p class="mt-50">-用其他方式登入-</p>
                    <p class="gap-items-2 mb-20">
                        <a class="btn btn-social-icon btn-round btn-facebook" href="#"><i class="fa fa-facebook"></i></a>
                        <a class="btn btn-social-icon btn-round btn-twitter" href="#"><i class="fa fa-twitter"></i></a>
                        <a class="btn btn-social-icon btn-round btn-google" href="#"><i class="fa fa-google"></i></a>
                        <a class="btn btn-social-icon btn-round btn-instagram" href="#"><i class="fa fa-instagram"></i></a>
                    </p>
                </div>
                <!-- /.social-auth-links -->

                <div class="margin-top-30 text-center text-dark">
                    <p>已經有帳號了? <a href="{{route('login')}}" class="text-info m-l-5">登入</a></p>
                </div>

            </div>
        </div>

    </div>
    </body>
@stop



