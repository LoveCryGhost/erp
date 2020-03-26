@if(Auth::guard('admin')->check())
<div id="guard-switcher" class="text-center">
    <div class="align-middle mt-10">
        <a href="{{route('login')}}">
            @if(Auth::guard('web')->check())
                <span class="badge badge-pill badge-success"> User </span>
            @else
                <span class="badge badge-pill badge-default"> User </span>
            @endif
        </a>
    </div>
    <div class="align-middle mt-2">
        <a href="{{route('member.login')}}">
            @if(Auth::guard('member')->check())
                <span class="badge badge-pill badge-success">Member</span>
            @else
                <span class="badge badge-pill badge-default">Member</span>
            @endif
        </a>
    </div>
    <div class="align-middle mt-2">
        <a href="{{route('admin.login')}}">
            @if(Auth::guard('admin')->check())
                <span class="badge badge-pill badge-success">Admin</span>
            @else
                <span class="badge badge-pill badge-default">Admin</span>
            @endif
        </a>
    </div>

    <div class="align-middle mt-2">
        <a href="{{route('staff.login')}}">
            @if(Auth::guard('staff')->check())
                <span class="badge badge-pill badge-success">Staff</span>
            @else
                <span class="badge badge-pill badge-default">Staff</span>
            @endif
        </a>
    </div>
</div>

@php
    $users = App\Models\User::get();
    $members = App\Models\Member::get();
    $staffs = App\Models\Staff::get();
    $admins = App\Models\Admin::get();
@endphp



<div id="guard-switcher-user" class="text-center">
    <div class="align-middle mt-10">
        <form class="frm-guard-switcher-user" method="post" action="{{route('admin.tool.guard_switcher_user')}}">
            @csrf
            <input type="text" name="guard" hidden>
            <input type="text" name="id" hidden>
            <input type="text" name="url" hidden>

            User:
            <select class="form-control" id="slt-user" data-select-id="slt-user" data-guard="web">
                <option selected>Select...</option>
                @foreach($users as $user)
                    @auth('web')
                    <option value="{{$user->id}}" {{$user->id==Auth::guard('web')->user()->id? "selected":""}}>{{$user->name}}</option>
                    @else
                    <option value="{{$user->id}}">{{$user->name}}</option>
                    @endauth
                @endforeach
            </select>

            Member:
            <select class="form-control" id="slt-member" data-select-id="slt-member" data-guard="member">
                <option selected>Select...</option>
                @foreach($members as $member)
                    @auth('member')
                    <option value="{{$member->id}}" {{$member->id==Auth::guard('member')->user()->id? "selected":""}}>{{$member->name}}</option>
                    @else
                    <option value="{{$member->id}}">{{$member->name}}</option>
                    @endauth
                @endforeach
            </select>

            Admin:
            <select class="form-control" id="slt-admin" data-select-id="slt-admin" data-guard="admin">
                <option selected>Select...</option>
                @foreach($admins as $admin)
                    <option value="{{$admin->id}}" {{$admin->id==Auth::guard('admin')->user()->id? "selected":""}}>{{$admin->name}}</option>
                @endforeach
            </select>

            Staff:
            <select class="form-control" id="slt-admin" data-select-id="slt-admin" data-guard="staff">
                <option selected>Select...</option>
                @foreach($staffs as $staff)
                    @auth('staff')
                        <option value="{{$staff->id}}" {{$staff->id==Auth::guard('staff')->user()->id? "selected":""}}>{{$staff->name}}</option>
                    @else
                        <option value="{{$staff->id}}">{{$staff->name}}</option>
                    @endauth
                @endforeach
            </select>
        </form>
    </div>
</div>
@endif


<style type="text/css">
    #guard-switcher{
        position:fixed;
        top: 410px;
        bottom: 0px;
        right: 0px;
        width: 70px;
        height: 130px;
        background: lightgrey;
        border: lightgrey solid 1px;
        z-index: 99;
    }

    #guard-switcher-user{
        position:fixed;
        top: 550px;
        right: 0px;
        width: 70px;
        height: auto;
        padding: 5px;
        background: lightgrey;
        border: lightgrey solid 1px;
        z-index: 99;
    }
</style>

{{--<div class="side-bar">--}}
    {{--<a href="#" class="icon-qq">xxx</a>--}}
    {{--<a href="#" class="icon-chat">微信<div class="chat-tips"><i></i>--}}
            {{--<img style="width:138px;height:138px;" src="" alt="微信订阅号"></div></a>--}}
    {{--<a target="_blank" href="" class="icon-blog">微博</a>--}}
{{--</div>--}}
{{--<style>--}}
    {{--.side-bar {width: 66px;position: fixed;top: 500px;right: 0px;font-size: 0;line-height: 0;z-index: 100;}--}}
    {{--/*.side-bar a,.chat-tips i {background: url('right_bg.png') no-repeat;}*/--}}
    {{--.side-bar a {width: 66px;height: 66px; display: inline-block;background-color: #ddd; margin-bottom: 2px;}--}}
    {{--.side-bar a:hover {background-color: #669fdd;}--}}
    {{--.side-bar .icon-qq {background-position: 0 -62px;}--}}
    {{--.side-bar .icon-chat {background-position: 0 -130px;position: relative;}--}}
    {{--.side-bar .icon-blog {background-position: 0 -198px;}--}}
    {{--.side-bar .icon-mail {background-position: 0 -266px;}--}}

    {{--.side-bar .icon-chat:hover .chat-tips {display: block;}--}}
    {{--.chat-tips {padding: 20px;border: 1px solid #d1d2d6;position: absolute;right: 78px;top: -55px;background-color: #fff;display: none;}--}}
    {{--.chat-tips i {width: 9px;height: 16px;display: inline-block;position: absolute;right: -9px;top: 80px;background-position:-88px -350px;}--}}
    {{--.chat-tips img {width: 138px;height: 138px;}--}}
{{--</style>--}}

<script>
$(function () {
    _frm = $('.frm-guard-switcher-user');
    $('.frm-guard-switcher-user select').on('change', function() {

        _select_id = $(this).data('select-id');
            console.log(_select_id);
        _id = $(this).children("option:selected"). val();
            console.log($(this).children("option:selected"). val());
        _guard = $(this).data('guard');
        _url = "{{url()->current()}}";
            console.log(_url);

        $('.frm-guard-switcher-user input[name=guard]').val(_guard);
        $('.frm-guard-switcher-user input[name=id]').val(_id);
        $('.frm-guard-switcher-user input[name=url]').val(_url);

        _frm.submit();
    });
})
</script>
