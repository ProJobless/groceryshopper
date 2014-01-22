@extends('admin.layouts.default')
{{-- Web site Title --}}
@section('title')
	{{{ $title }}} :: @parent
@stop

@section('keywords')Stores administration @stop
@section('author')Grocery Shopper @stop
@section('description')Stores administration index @stop

{{-- Page Title --}}
@section('pagetitle')
	{{{ $title }}}
@stop

{{-- Breadcrumbs --}}
@section('breadcrumb')
	 @parent

@stop
{{-- Content --}}
@section('content')
				<div class="row">
					<div class="col-xs-12">
					<!-- Notifications -->
					@include('notifications')
					<!-- ./ notifications -->
					</div>
				</div>
		<div class="row">
		    <div class="col-xs-12">
			<div class="widget-box">
				<div class="widget-title">
					@yield('formtitle')
				</div>
				<div class="widget-content nopadding">
				<!-- Content -->
				@yield('formcontent')
				</div>
			</div>
			<!-- ./ content -->
		     </div>
		</div>
@stop
{{-- Scripts --}}
@section('scripts')
	<script type="text/javascript">
		$(document).ready(function(){
			$('input[type=checkbox],input[type=radio]').iCheck({
			checkboxClass: 'icheckbox_flat-blue',
			radioClass: 'iradio_flat-blue'
			});
      $('select').select2();
			
		});
	</script>
@stop
