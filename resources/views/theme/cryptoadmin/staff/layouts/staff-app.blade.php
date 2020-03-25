{{--繼承--}}
@extends('layouts.app')


{{--標題--}}
<title>Staff - @yield('title')</title>


{{--CSS--}}
@include(config('theme.staff.css.default'))
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
        @guest('staff')
            @include(config('theme.staff.header'))
        @else
            @include(config('theme.staff.header-login'))
            @include(config('theme.staff.sidebar'))
        @endguest
    @endsection

    <div class="wrapper">
        <div class="content-wrapper">
            @yield('content')
        </div>
    </div>

    @section('app-content-footer')
        @yield('content-footer')
        @auth('staff')
            @include(config('theme.staff.footer'))
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
@include(config('theme.staff.js.default'))
