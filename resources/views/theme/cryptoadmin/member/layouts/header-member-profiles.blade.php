<li class="dropdown user user-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="User">
        <img src="{{ Auth::guard('member')->user()->avatar }}" class="user-image rounded-circle" alt="User Image">
    </a>
    <ul class="dropdown-menu animated flipInX">
        <!-- User image -->
        <li class="user-header bg-img" style="background-image: url({{asset('theme/cryptoadmin/images/user-info.jpg')}})" data-overlay="3">
            <div class="flexbox align-self-center">
                <img src="{{ Auth::guard('member')->user()->avatar }}" class="float-left rounded-circle" alt="User Image">
                <h4 class="user-name align-self-center">
                    <span>{{Auth::guard('member')->user()->name}}</span><br>
                    <small>{{Auth::guard('member')->user()->email}}</small><br>
                    <small> {{__('default.info.join_at')}} : {{Auth::guard('member')->user()->created_at->diffForHumans()}}</small>
                </h4>
            </div>
        </li>
        <!-- Menu Body -->
        <li class="user-body">
            <a class="dropdown-item" href="{{route('member.edit', ['member'=> Auth::guard('member')->user()->id])}}">
                <i class="ion ion-person text-primary"></i> {{__('default.info.member_info')}}</a>
            <a class="dropdown-item" href="{{ route('member.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <i class="fa fa-sign-out text-primary"></i> {{__('default.info.logout')}}
            </a>
            <form id="logout-form" action="{{ route('member.logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</li>
