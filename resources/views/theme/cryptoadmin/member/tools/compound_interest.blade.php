@extends(config('theme.member.member-app'))

@section('title',__('member/tools.table.compound_interest.title'))

@section('content-header','')

@section('content')
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <h3>
                {{__('member/tools.table.compound_interest.title')}}
            </h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="breadcrumb-item"><a href="#">Members</a></li>
                <li class="breadcrumb-item active">Members List</li>
            </ol>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="itable">
                                    <thead>
                                    <tr>
                                        <th colspan="27" class="text-left">
                                            <span class="">{{__('member/tools.table.compound_interest.unit')}}</span>
                                        </th>
                                    </tr>
                                    <tr >
                                        <th>No</th>
                                        <th>{{__('member/tools.table.compound_interest.year')}}</th>
                                        <th>{{__('member/tools.table.compound_interest.capital')}}</th>
                                        @for($i=1; $i<=24; $i++)
                                            <th>{{$i}}%</th>
                                        @endfor
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @for($year=1; $year<=20; $year++)
                                        <tr>
                                            <td>{{$year}}</td>
                                            <td>{{$year}}</td>
                                            <td>{{$capital_0 = $capital/1000}}</td>
                                            @for($i=1; $i<=24; $i++)
                                                <td class="text-right">{{number_format(($capital_0*pow(1+$i/100,$year)),1, ".", ",")}}</td>
                                            @endfor
                                        </tr>
                                    @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@stop

@section('js')
    @parent

@endsection



