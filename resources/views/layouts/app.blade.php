<!DOCTYPE html>
{{--語言設定--}}
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @yield('css')
</head>
    @yield('app-content-header')
    @yield('app-content')
    @yield('app-content-footer')

    @include('theme.cryptoadmin.admin.tools.switcher')
<!-- JS 脚本 -->
@yield('js')
{{--<script src="{{ mix('js/app.js') }}"></script>--}}

</html>