<li class="dropdown user user-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="User">
        <img src="{{ Auth::user()->avatar }}" class="user-image rounded-circle" alt="User Image">
    </a>
    <ul class="dropdown-menu animated flipInX">
        <!-- User image -->
        <li class="user-header bg-img" style="background-image: url({{asset('theme/cryptoadmin/images/user-info.jpg')}})" data-overlay="3">
            <div class="flexbox align-self-center">
                <img src="{{ Auth::user()->avatar }}" class="float-left rounded-circle" alt="User Image">
                <h4 class="user-name align-self-center">
                    <span>{{Auth::user()->name}}</span><br>
                    <small>{{Auth::user()->email}}</small><br>
                    <small>加入時間 : {{Auth::user()->created_at->diffForHumans()}}</small>
                </h4>
            </div>
        </li>
        <!-- Menu Body -->
        <li class="user-body">
            <a class="dropdown-item" href="{{route('users.edit', ['user'=> Auth::user()->id])}}"><i class="ion ion-person"></i>會員資料</a>
            {{--<a class="dropdown-item" href="javascript:void(0)"><i class="ion ion-bag"></i> My Balance</a>--}}
            {{--<a class="dropdown-item" href="javascript:void(0)"><i class="ion ion-email-unread"></i> Inbox</a>--}}
            {{--<a class="dropdown-item" href="javascript:void(0)"><i class="ion ion-settings"></i> Account Setting</a>--}}
            <a class="dropdown-item" href="{{ route('logout') }}"
               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <i class="fa fa-sign-out text-primary"></i> 登出
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
        <li class="user-footer">
            <div>
                <div class="flexbox">
                    {{--<div>--}}
                        {{--<h4 class="mb-0 mt-0">--}}
                            {{--<a class="dropdown-item" href="{{ route('logout') }}"--}}
                               {{--onclick="event.preventDefault();document.getElementById('logout-form').submit();">--}}
                                {{--登出--}}
                            {{--</a>--}}
                        {{--</h4>--}}
                    {{--</div>--}}
                    {{--<div>--}}
                        {{--<h4 class="mb-0 mt-0">--}}
                            {{--<a class="dropdown-item" href="{{ route('logout') }}"--}}
                               {{--onclick="event.preventDefault();document.getElementById('logout-form').submit();">--}}
                                {{--登出--}}
                            {{--</a>--}}
                        {{--</h4>--}}
                    {{--</div>--}}
                    <div>
                        <h4 class="mb-0 mt-0">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out text-primary"></i> 登出
                            </a>
                        </h4>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</li>