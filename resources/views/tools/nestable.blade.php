<!DOCTYPE html>
<head>
  <meta charset="utf-8">
	<!-- Bootstrap min 4.0-->
	<link rel="stylesheet" href="{{asset('theme/cryptoadmin/vendor_components/bootstrap/dist/css/bootstrap.min.css')}}">

    <!--nestable CSS -->
    <link href="{{asset('theme/cryptoadmin/vendor_components/nestable/nestable.css')}}" rel="stylesheet" type="text/css" />
	
	<!-- Bootstrap 4.0-->
	<link rel="stylesheet" href="{{asset('theme/cryptoadmin/vendor_components/bootstrap/dist/css/bootstrap.css')}}">
	
	<!-- theme style -->
	<link rel="stylesheet" href="{{asset('theme/cryptoadmin/css/style.css')}}">
	
</head>
<form method="get" >
	<textarea name="nestable_output" id="nestable_output"></textarea>
	<button type="submit" name="submit" value="get">save</button>
</form>
	<div class="col-xl-4 col-12">
	  <div class="box">
		<div class="box-header with-border">
		  <h4 class="box-title">Nestable 1</h4>
		</div>
		<div class="box-body">
			<div class="myadmin-dd dd" id="nestable">
				<ol class="dd-list">
					<li class="dd-item" data-id="1" data-name="AndyJun">
						<div class="dd-handle"> Item 1 </div>
					</li>
					<li class="dd-item" data-id="2" data-name="AndyJun">
						<div class="dd-handle"> Item 2 </div>
						<ol class="dd-list">
							<li class="dd-item" data-id="3" data-name="AndyJun">
								<div class="dd-handle"> Item 3 </div>
							</li>
							<li class="dd-item" data-id="4" data-name="AndyJun">
								<div class="dd-handle"> Item 4 </div>
							</li>
							<li class="dd-item" data-id="5" data-name="AndyJun">
								<div class="dd-handle"> Item 5 </div>
								<ol class="dd-list">
									<li class="dd-item" data-id="6" data-name="AndyJun">
										<div class="dd-handle"> Item 6 </div>
									</li>
									<li class="dd-item" data-id="7" data-name="AndyJun">
										<div class="dd-handle"> Item 7 </div>
									</li>
									<li class="dd-item" data-id="8" data-name="AndyJun">
										<div class="dd-handle"> Item 8 </div>
									</li>
								</ol>
							</li>
							<li class="dd-item" data-id="9" data-name="AndyJun">
								<div class="dd-handle"> Item 9 </div>
							</li>
							<li class="dd-item" data-id="10" data-name="AndyJun">
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
					<li class="dd-item dd3-item" data-id="13" data-name="AndyJun">
						<div class="dd-handle dd3-handle"></div>
						<div class="dd3-content"> Item 13 </div>
					</li>
					<li class="dd-item dd3-item" data-id="14" data-name="AndyJun">
						<div class="dd-handle dd3-handle"></div>
						<div class="dd3-content"> Item 14 </div>
					</li>
					<li class="dd-item dd3-item" data-id="14" data-name="AndyJun">
						<div class="dd-handle dd3-handle"></div>
						<div class="dd3-content"> Item 16 </div>
					</li>
					<li class="dd-item dd3-item" data-id="14" data-name="AndyJun">
						<div class="dd-handle dd3-handle"></div>
						<div class="dd3-content"> Item 17 </div>
					</li>
					<li class="dd-item dd3-item" data-id="14" data-name="AndyJun">
						<div class="dd-handle dd3-handle"></div>
						<div class="dd3-content"> Item 18 </div>
					</li>
					<li class="dd-item dd3-item" data-id="14" data-name="AndyJun">
						<div class="dd-handle dd3-handle"></div>
						<div class="dd3-content"> Item 19 </div>
					</li>
					<li class="dd-item dd3-item" data-id="15" data-name="AndyJun">
						<div class="dd-handle dd3-handle"></div>
						<div class="dd3-content"> Item 15 </div>
						<ol class="dd-list">
							<li class="dd-item dd3-item" data-id="16" data-name="AndyJun">
								<div class="dd-handle dd3-handle"></div>
								<div class="dd3-content"> Item 16 </div>
							</li>
							<li class="dd-item dd3-item" data-id="17" data-name="AndyJun">
								<div class="dd-handle dd3-handle"></div>
								<div class="dd3-content"> Item 17 </div>
							</li>
							<li class="dd-item dd3-item" data-id="18" data-name="AndyJun">
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
					<li class="dd-item" data-id="13" data-name="AndyJun">
						<div class="dd-handle">Item 13</div>
					</li>
					<li class="dd-item" data-id="13" data-name="AndyJun">
						<div class="dd-handle">Item 13</div>
					</li>
					<li class="dd-item" data-id="14" data-name="AndyJun">
						<div class="dd-handle">Item 14</div>
					</li>
					<li class="dd-item" data-id="15" data-name="AndyJun">
						<div class="dd-handle">Item 15</div>
						<ol class="dd-list">
							<li class="dd-item" data-id="16" data-name="AndyJun">
								<div class="dd-handle">Item 16</div>
							</li>
							<li class="dd-item" data-id="17" data-name="AndyJun">
								<div class="dd-handle">Item 17</div>
							</li>
							<li class="dd-item" data-id="18" data-name="AndyJun">
								<div class="dd-handle">Item 18</div>
							</li>
							<li class="dd-item" data-id="16" data-name="AndyJun">
								<div class="dd-handle">Item 19</div>
							</li>
							<li class="dd-item" data-id="17" data-name="AndyJun">
								<div class="dd-handle">Item 20</div>
							</li>
							<li class="dd-item" data-id="18" data-name="AndyJun">
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


<!-- jQuery 3 -->
<script src="{{asset('theme/cryptoadmin/vendor_components/jquery-3.3.1/jquery-3.3.1.js')}}"></script>

<!-- Bootstrap 4.0-->
<script src="{{asset('theme/cryptoadmin/vendor_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>

<!--Nestable js -->
<script src="{{asset('theme/cryptoadmin/vendor_components/nestable/jquery.nestable.js')}}"></script>


<!-- Crypto Admin App -->
<script src="{{asset('theme/cryptoadmin/js/template.js')}}"></script>

<!-- Crypto Admin for demo purposes -->

<script src="{{asset('theme/cryptoadmin/js/demo.js')}}"></script>

{{--<script src="{{asset('theme/cryptoadmin/js/pages/nestable.js')}}"></script>--}}
<script>
    var updateOutput = function (e) {
        console.log(typeof ($('#nestable2').data('output')));
        console.log($('#nestable2').data('output').val());
        console.log($('#nestable2').data());
        var list = e.length ? e : $(e.target)
            , output = list.data('output');
        if (window.JSON) {
            output.val(window.JSON.stringify(list.nestable('serialize'))); //, null, 2));
        }
        else {
            output.val('JSON browser support required for this demo.');
        }
    };
    
	$('#nestable2').nestable({
		group: 1
	}).on('change', updateOutput);
	updateOutput($('#nestable2').data('output', $('#nestable_output')));
</script>

