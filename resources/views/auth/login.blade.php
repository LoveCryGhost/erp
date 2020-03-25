@extends(config('theme.user.user-app-login'))

@section('title','用戶-登入')


{{--清空--}}
@section('app-content','')

@section('content-header')
    <body class="hold-transition theme-yellow bg-img" data-overlay="3">
    <div class="auth-2-outer row align-items-center h-p100 m-0">
        <div class="auth-2">
            <div class="auth-logo font-size-30">
                <a href="/" class="text-dark">主 頁</a>
            </div>
            <!-- /.login-logo -->
            <div class="auth-body">
                <p class="auth-msg text-black-50">登入 - 可享會員福利</p>

                <form action="{{route('login')}}" method="post" class="form-element">
                    @csrf
                    <div class="form-group has-feedback">
                        <input type="email" class="form-control" name="email" required placeholder="Email" value="{{ old('email')}}">
                        <span class="ion ion-email form-control-feedback text-dark"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" name="password"  required placeholder="Password">
                        <span class="ion ion-locked form-control-feedback text-dark"></span>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="checkbox">
                                <input type="checkbox"  name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label for="remember" class="text-dark">記住我</label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-6">
                            <div class="fog-pwd">
                                <a href="{{route('password.request')}}"><i class="ion ion-locked"></i> 忘記密碼 ?</a><br>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-12 text-center pt-30">
                            <button type="submit" class="btn btn my-20 btn-success">登入</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <div class="text-center text-dark">
                    <p class="mt-50">- 其他登入方式 -</p>
                    <p class="gap-items-2 mb-20">
                        <a class="btn btn-social-icon btn-round btn-facebook" href="#"><i class="fa fa-facebook"></i></a>
                        <a class="btn btn-social-icon btn-round btn-twitter" href="#"><i class="fa fa-twitter"></i></a>
                        <a class="btn btn-social-icon btn-round btn-google" href="#"><i class="fa fa-google"></i></a>
                        <a class="btn btn-social-icon btn-round btn-instagram" href="#"><i class="fa fa-instagram"></i></a>
                    </p>
                </div>
                <!-- /.social-auth-links -->

                <div class="margin-top-30 text-center text-dark">
                    <p>不是會員?   <a href="{{route('register')}}" class="text-info ml-20">註冊</a></p>
                </div>

            </div>
        </div>

    </div>
@stop



