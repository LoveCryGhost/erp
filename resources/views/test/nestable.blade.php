<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
	<!-- Bootstrap 4.0-->
	<link rel="stylesheet" href="{{asset('theme/cryptoadmin/vendor_components/bootstrap/dist/css/bootstrap.min.css')}}">

    <!--nestable CSS -->
    <link href="{{asset('theme/cryptoadmin/vendor_components/nestable/nestable.css')}}" rel="stylesheet" type="text/css" />
	
	<!-- Bootstrap 4.0-->
	<link rel="stylesheet" href="{{asset('theme/cryptoadmin/vendor_components/bootstrap/dist/css/bootstrap.css')}}">
	
	<!-- theme style -->
	<link rel="stylesheet" href="{{asset('theme/cryptoadmin/css/style.css')}}">
	
</head>
<body class="hold-transition light-skin dark-sidebar sidebar-mini theme-yellow">
<!-- Site wrapper -->
<div class="wrapper">

  <div class="content-wrapper">
	  <div class="container-full">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<h3>
				Nestable
		  	</h3>
		  	<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="breadcrumb-item"><a href="#">UI</a></li>
        		<li class="breadcrumb-item active">Nestable</li>
		  	</ol>
		</div>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-xl-4 col-12">
				  <div class="box">
					<div class="box-header with-border">
					  <h4 class="box-title">Nestable 1</h4>
					</div>
					<div class="box-body">
						<div class="myadmin-dd dd" id="nestable">
							<ol class="dd-list">
								<li class="dd-item" data-id="1">
									<div class="dd-handle"> Item 1 </div>
								</li>
								<li class="dd-item" data-id="2">
									<div class="dd-handle"> Item 2 </div>
									<ol class="dd-list">
										<li class="dd-item" data-id="3">
											<div class="dd-handle"> Item 3 </div>
										</li>
										<li class="dd-item" data-id="4">
											<div class="dd-handle"> Item 4 </div>
										</li>
										<li class="dd-item" data-id="5">
											<div class="dd-handle"> Item 5 </div>
											<ol class="dd-list">
												<li class="dd-item" data-id="6">
													<div class="dd-handle"> Item 6 </div>
												</li>
												<li class="dd-item" data-id="7">
													<div class="dd-handle"> Item 7 </div>
												</li>
												<li class="dd-item" data-id="8">
													<div class="dd-handle"> Item 8 </div>
												</li>
											</ol>
										</li>
										<li class="dd-item" data-id="9">
											<div class="dd-handle"> Item 9 </div>
										</li>
										<li class="dd-item" data-id="10">
											<div class="dd-handle"> Item 10 </div>
										</li>
									</ol>
								</li>
							</ol>
						</div>
					</div>
				</div>
				</div>
				<div class="col-xl-4 col-12">
				  <div class="box">
					<div class="box-header with-border">
					  <h4 class="box-title">Nestable 2</h4>
					</div>
					<div class="box-body">
						<div class="myadmin-dd-empty dd" id="nestable2">
							<ol class="dd-list">
								<li class="dd-item dd3-item" data-id="13">
									<div class="dd-handle dd3-handle"></div>
									<div class="dd3-content"> Item 13 </div>
								</li>
								<li class="dd-item dd3-item" data-id="14">
									<div class="dd-handle dd3-handle"></div>
									<div class="dd3-content"> Item 14 </div>
								</li>
								<li class="dd-item dd3-item" data-id="14">
									<div class="dd-handle dd3-handle"></div>
									<div class="dd3-content"> Item 16 </div>
								</li>
								<li class="dd-item dd3-item" data-id="14">
									<div class="dd-handle dd3-handle"></div>
									<div class="dd3-content"> Item 17 </div>
								</li>
								<li class="dd-item dd3-item" data-id="14">
									<div class="dd-handle dd3-handle"></div>
									<div class="dd3-content"> Item 18 </div>
								</li>
								<li class="dd-item dd3-item" data-id="14">
									<div class="dd-handle dd3-handle"></div>
									<div class="dd3-content"> Item 19 </div>
								</li>
								<li class="dd-item dd3-item" data-id="15">
									<div class="dd-handle dd3-handle"></div>
									<div class="dd3-content"> Item 15 </div>
									<ol class="dd-list">
										<li class="dd-item dd3-item" data-id="16">
											<div class="dd-handle dd3-handle"></div>
											<div class="dd3-content"> Item 16 </div>
										</li>
										<li class="dd-item dd3-item" data-id="17">
											<div class="dd-handle dd3-handle"></div>
											<div class="dd3-content"> Item 17 </div>
										</li>
										<li class="dd-item dd3-item" data-id="18">
											<div class="dd-handle dd3-handle"></div>
											<div class="dd3-content"> Item 18 </div>
										</li>
									</ol>
								</li>
							</ol>
						</div>
					</div>
					<!-- /.box-body -->
				  </div>
				<!-- /.box -->
				</div>
				<div class="col-xl-4 col-12">
				  <div class="box">
					<div class="box-header with-border">
					  <h4 class="box-title">Nestable 3</h4>
					</div>
					<div class="box-body">
						<div class="dd myadmin-dd" id="nestable-menu">
							<ol class="dd-list">
								<li class="dd-item" data-id="13">
									<div class="dd-handle">Item 13</div>
								</li>
								<li class="dd-item" data-id="13">
									<div class="dd-handle">Item 13</div>
								</li>
								<li class="dd-item" data-id="14">
									<div class="dd-handle">Item 14</div>
								</li>
								<li class="dd-item" data-id="15">
									<div class="dd-handle">Item 15</div>
									<ol class="dd-list">
										<li class="dd-item" data-id="16">
											<div class="dd-handle">Item 16</div>
										</li>
										<li class="dd-item" data-id="17">
											<div class="dd-handle">Item 17</div>
										</li>
										<li class="dd-item" data-id="18">
											<div class="dd-handle">Item 18</div>
										</li>
										<li class="dd-item" data-id="16">
											<div class="dd-handle">Item 19</div>
										</li>
										<li class="dd-item" data-id="17">
											<div class="dd-handle">Item 20</div>
										</li>
										<li class="dd-item" data-id="18">
											<div class="dd-handle">Item 21</div>
										</li>
									</ol>
								</li>
							</ol>
						</div>
					</div>
					<!-- /.box-body -->
				  </div>
				<!-- /.box -->
			  	</div>
			</div>
		</section>
		<!-- /.content -->
	  </div>
  </div>
  <!-- /.content-wrapper -->

</div>
<!-- ./wrapper -->


	<!-- jQuery 3 -->
	<script src="{{asset('theme/cryptoadmin/vendor_components/jquery-3.3.1/jquery-3.3.1.js')}}"></script>

	<!-- fullscreen -->
	<script src="{{asset('theme/cryptoadmin/vendor_components/screenfull/screenfull.js')}}"></script>

	<!-- popper -->
	<script src="{{asset('theme/cryptoadmin/vendor_components/popper/dist/popper.min.js')}}"></script>

	<!-- Bootstrap 4.0-->
	<script src="{{asset('theme/cryptoadmin/vendor_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>

    <!--Nestable js -->
    <script src="{{asset('theme/cryptoadmin/vendor_components/nestable/jquery.nestable.js')}}"></script>
	<script src="{{asset('theme/cryptoadmin/js/pages/nestable.js')}}"></script>

	<!-- SlimScroll -->
	<script src="{{asset('theme/cryptoadmin/endor_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>

	<!-- FastClick -->
	<script src="{{asset('theme/cryptoadmin/vendor_components/fastclick/lib/fastclick.js')}}"></script>
	
	<!-- Crypto Admin App -->
	<script src="{{asset('theme/cryptoadmin/js/template.js')}}"></script>
	
	<!-- Crypto Admin for demo purposes -->
	<script src="{{asset('theme/cryptoadmin/js/demo.js')}}"></script>


</body>
</html>
