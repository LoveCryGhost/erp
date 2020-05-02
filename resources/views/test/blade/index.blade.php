@extends('test.blade.app')

@section('css')
	@parent
	@include('test.blade.css_default')
@endsection



@section('main_header')
	@include('test.blade.header')
@endsection

@section('main_sidebar')
	@include('test.blade.sidebar')
@endsection

@section('navigator')
	<h3>
		Boxed Layout
	</h3>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="breadcrumb-item"><a href="#">Layout</a></li>
		<li class="breadcrumb-item active">Boxed Layout</li>
	</ol>
@endsection

@section('content')
	<div class="row">
		<div class="col-12">
			<div class="callout callout-info">
				<h4>Tip!</h4>
				
				<p>Add the layout-boxed class to the body tag to get this layout. The boxed layout is helpful when working on
					large screens because it prevents the site from stretching very wide.</p>
			</div>
		</div>
		<div class="col-12">
			<div class="box">
				<div class="box-header with-border">
					<h4 class="box-title">Title</h4>
				</div>
				<div class="box-body">
					Start creating your amazing application!
				</div>
				<div class="box-footer">
					Footer
				</div>
			</div>
		</div>
	</div>
@endsection
@section('main_footer')
	@include('test.blade.footer')
@endsection

@section('js')
	@parent
	@include('test.blade.js_default')
@endsection