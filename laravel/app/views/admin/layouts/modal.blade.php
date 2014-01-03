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
	 <a href="{{{ URL::to('admin/users') }}}" title="Manage users" class="tip-bottom"><i class="fa fa-user"></i> Users</a>

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
					<span class="icon"><i class="fa fa-user"></i></span>
					<h5>Create a new User</h5>
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
