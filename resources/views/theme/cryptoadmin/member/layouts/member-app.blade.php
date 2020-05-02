{{--繼承--}}
@extends('layouts.app')


{{--標題--}}
<title>member - @yield('title')</title>



@section('css')
    @parent
    @yield('css')
@endsection


{{--繼承內容--}}
@section('app-content-header')
    @yield('content-header')
@endsection

@include(config('theme.member.css.default'))

<body class="hold-transition fixed light-skin dark-sidebar sidebar-mini theme-blue sidebar-collapse">
<div id="app"  class="{{ route_class() }}-page xbody">
    @section('app-content')
        @guest('member')
            @include(config('theme.member.header'))
        @else
            @include(config('theme.member.header-login'))
            @include(config('theme.member.sidebar'))
        @endguest
    @endsection

    <div class="wrapper">
        <div class="content-wrapper">
            @yield('content')
        </div>
    </div>

    @section('app-content-footer')
        @yield('content-footer')
        @auth('member')
            @include(config('theme.member.footer'))
        @endauth
    @endsection
</div>
</body>

{{--JS--}}
@section('js')
    @parent
    @yield('js')
@endsection

@include(config('theme.member.js.default'))
