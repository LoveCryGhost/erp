{{--繼承--}}
@extends('layouts.app')


{{--標題--}}
<title>User - @yield('title')</title>


{{--CSS--}}
@include(config('theme.user.css.default'))
@section('css')
    @parent
    @yield('css')
@endsection


{{--繼承內容--}}
@section('app-content-header')
    @yield('content-header')
@endsection

@section('app-content')
@endsection

@section('app-content-footer')
@endsection


{{--JS--}}
@section('js')
    @parent
    @yield('js')
@endsection

{{--Footer--}}
@include(config('theme.user.js.default'))