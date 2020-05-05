<!-- Notifications -->
<li class="dropdown notifications-menu">
    <a href="#" class="" data-toggle="dropdown" title="Notifications">
        @switch(Session::get('locale'))
            @case("en")
            <i class="flag-icon flag-icon-us"></i>
                @break
            
            @case("cn")
            <i class="flag-icon flag-icon-cn"></i>
                @break
                
            @case("tw")
            <i class="flag-icon flag-icon-tw"></i>
                @break
                
            @case("id")
            <i class="flag-icon flag-icon-id"></i>
                @break
                
            @case("th")
            <i class="flag-icon flag-icon-th"></i>
                @break
                
            @case("vn")
            <i class="flag-icon flag-icon-vn"></i>
                @break
                
            @default
            <i class="flag-icon flag-icon-us"></i>
        @endswitch
    </a>
    <ul class="dropdown-menu animated bounceIn">
        <li>
            <!-- inner menu: contains the actual data -->
            <ul class="menu sm-scrol">
                <li><a href="{{ url('locale/en') }}"><i class="flag-icon flag-icon-us"></i> {{__('default.language.en')}}
                        {!! Session::get('locale')=="en"? '<sapn class="text-right text-primary"> V </sapn>':"" !!}
                    </a></li>
                <li><a href="{{ url('locale/cn') }}"><i class="flag-icon flag-icon-cn"></i> {{__('default.language.cn')}}
                        {!! Session::get('locale')=="cn"? '<sapn class="text-right text-primary"> V </sapn>':"" !!}
                    </a></li>
                <li><a href="{{ url('locale/tw') }}"><i class="flag-icon flag-icon-tw"></i> {{__('default.language.tw')}}
                        {!! Session::get('locale')=="tw"? '<sapn class="text-right text-primary"> V </sapn>':"" !!}
                    </a></li>
                <li><a href="{{ url('locale/id') }}"><i class="flag-icon flag-icon-id"></i> {{__('default.language.id')}}
                        {!! Session::get('locale')=="id"? '<sapn class="text-right text-primary"> V </sapn>':"" !!}
                    </a></li>
                <li><a href="{{ url('locale/th') }}"><i class="flag-icon flag-icon-th"></i> {{__('default.language.th')}}
                        {!! Session::get('locale')=="th"? '<sapn class="text-right  text-primary"> V </sapn>':"" !!}
                    </a></li>
                <li><a href="{{ url('locale/vn') }}"><i class="flag-icon flag-icon-vn"></i> {{__('default.language.vn')}}
                        {!! Session::get('locale')=="vn"? '<sapn class="text-right text-primary"> V </sapn>':"" !!}
                    </a></li>
            </ul>
        </li>
    </ul>
</li>