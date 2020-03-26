{{--繼承--}}
@extends('layouts.app')


{{--標題--}}
<title>Admin - @yield('title')</title>


{{--CSS--}}
@include(config('theme.admin.css.default'))
@section('css')
    @parent
    @yield('css')
@endsection


{{--繼承內容--}}
    @section('app-content-header')
        @yield('content-header')
    @endsection

    <body class="hold-transition fixed light-skin dark-sidebar sidebar-mini theme-blue sidebar-collapse">
        <div id="app"  class="{{ route_class() }}-page">
            @section('app-content')
                @guest('admin')
                    @include(config('theme.admin.header'))
                @else
                    @include(config('theme.admin.header-login'))
                    @include(config('theme.admin.sidebar'))
                @endguest
            @endsection
                {{--內容--}}
                <div class="wrapper">
                    <div class="content-wrapper">
                        @yield('content')
                    </div>
                </div>

            @section('app-content-footer')
                @yield('content-footer')
                @auth('admin')
                    @include(config('theme.admin.footer'))
                @endauth
            @endsection
        </div>
    </body>

{{--JS--}}
@section('js')
    @parent
    @yield('js')
@endsection

{{--Footer--}}
@include(config('theme.admin.js.default'))