{{--需搭配CSS--}}
@section('js')
    @parent
    <!-- toast -->
    <script src="{{asset('theme/cryptoadmin/vendor_components/jquery-toast-plugin-master/src/jquery.toast.js')}}"></script>
    <script src="{{asset('theme/cryptoadmin/js/pages/toastr.js')}}"></script>
    <script src="{{asset('theme/cryptoadmin/js/pages/notification.js')}}"></script>
    <script>
        $(function () {
            @if(session()->has('toast'))
                @php
                    $toast = session()->get('toast');
                @endphp
                $.toast({
                    heading: "{{$toast['heading']}}",
                    text: "{{$toast['text']}}",
                    position: "{{$toast['position']}}",
                    loaderBg: "{{$toast['loaderBg']}}",
                    icon: "{{$toast['icon']}}",
                    hideAfter: "{{$toast['hideAfter']}}",
                    stack: "{{$toast['stack']}}",
                });
            @endif
        });

    </script>
@endsection