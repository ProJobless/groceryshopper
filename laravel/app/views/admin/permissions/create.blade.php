@extends('admin.layouts.modal')
{{-- Breadcrumbs --}}
@section('breadcrumb')
	 @parent
	 <a href="{{{ URL::to('admin/permissions') }}}" title="Manage permissions" class="tip-bottom"><i class="fa fa-user"></i>Permissions</a>
	 <a href="{{{ URL::to('admin/permissions/create') }}}" title="{{{ $title }}}" class="tip-bottom"><i class="fa fa-edit"></i>{{{ $title }}}</a>

@stop
@section('formtitle')
<span class="icon"><i class="fa fa-user"></i></span>
<h5>{{{ $title }}}</h5>
@stop

{{-- Content --}}
@section('formcontent')
	{{-- Create Permission Form --}}
	<form class="form-horizontal" method="post" action="" autocomplete="off">
		<!-- CSRF Token -->
		<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
		<!-- ./ csrf token -->

		<!-- Name -->
		<div class="form-group {{{ $errors->has('name') ? 'error' : '' }}}">
			<label class="col-md-2 control-label" for="name">System name</label>
			<div class="col-md-10">
			<input class="form-control" type="text" name="name" id="name" value="{{{ Input::old('name') }}}" />
			{{ $errors->first('name', '<span class="help-inline">:message</span>') }}
			</div>
		</div>
		<!-- ./ name -->

		<!-- display_name -->
		<div class="form-group {{{ $errors->has('display_name') ? 'error' : '' }}}">
			<label class="col-md-2 control-label" for="display_name">Name</label>
			<div class="col-md-10">
				<input class="form-control" type="text" name="display_name" id="display_name" value="{{{ Input::old('display_name') }}}" />
				{{{ $errors->first('display_name', '<span class="help-inline">:message</span>') }}}
			</div>
		</div>
		<!-- ./ display_name -->


		<!-- Form Actions -->
		<div class="form-actions">
			    <button type="submit" class="btn btn-success">Save changes</button>
			    <button type="button" class="btn">Cancel</button>
			    <button type="reset" class="btn btn-default">Reset</button>
		</div>
		<!-- ./ form actions -->
	</form>
@stop
