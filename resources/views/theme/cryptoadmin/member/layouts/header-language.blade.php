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
                <li><a href="{{ url('locale/en') }}" class="text-success"><i class="flag-icon flag-icon-us"></i> EN
                        {!! Session::get('locale')=="en"? '<sapn class="text-right text-primary"> V </sapn>':"" !!}
                    </a></li>
                <li><a href="{{ url('locale/cn') }}" class="text-success"><i class="flag-icon flag-icon-cn"></i> 中國(簡)
                        {!! Session::get('locale')=="cn"? '<sapn class="text-right text-primary"> V </sapn>':"" !!}
                    </a></li>
                <li><a href="{{ url('locale/tw') }}" class="text-success"><i class="flag-icon flag-icon-tw"></i> 中國(台灣-繁)
                        {!! Session::get('locale')=="tw"? '<sapn class="text-right text-primary"> V </sapn>':"" !!}
                    </a></li>
                <li><a href="{{ url('locale/id') }}" class="text-success"><i class="flag-icon flag-icon-id"></i> 印尼
                        {!! Session::get('locale')=="id"? '<sapn class="text-right text-primary"> V </sapn>':"" !!}
                    </a></li>
                <li><a href="{{ url('locale/th') }}" class="text-success"><i class="flag-icon flag-icon-th"></i> 泰國
                        {!! Session::get('locale')=="th"? '<sapn class="text-right  text-primary"> V </sapn>':"" !!}
                    </a></li>
                <li><a href="{{ url('locale/vn') }}" class="text-success"><i class="flag-icon flag-icon-vn"></i> 越南
                        {!! Session::get('locale')=="vn"? '<sapn class="text-right text-primary"> V </sapn>':"" !!}
                    </a></li>
            </ul>
        </li>
    </ul>
</li>