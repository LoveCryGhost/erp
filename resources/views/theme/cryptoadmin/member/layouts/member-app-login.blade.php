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
@include(config('theme.staff.js.default'))
