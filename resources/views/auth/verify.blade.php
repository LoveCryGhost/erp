@extends(config('theme.user.user-app'))

@section('title','驗證 - 郵箱')

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
                @if (session('resent'))
                    <div class="alert alert-success text-center" role="alert">
                        {{ __('郵箱驗証郵件已經發送至您的指定信箱!') }}
                    </div>
                @endif

                <p class="auth-msg text-black-50">您的Email還未驗證</p>


                {{--註冊提交按鈕--}}
                <div class="row">
                    <div class="col-12 text-center">
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-primary align-baseline mb-10">重新發送驗證郵件</button>
                        </form>
                    </div>
                    <!-- /.col -->
                </div>
            </div>
        </div>

    </div>
    </body>
@stop






