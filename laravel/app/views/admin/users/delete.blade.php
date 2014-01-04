@extends('admin.layouts.modal')
{{-- Breadcrumbs --}}
@section('breadcrumb')
	 @parent
	 <a href="{{{ URL::to('admin/users') }}}" title="Manage users" class="tip-bottom"><i class="fa fa-user"></i>Users</a>
	 <a href="{{{ URL::to('admin/users/'. $user->id . '/delete') }}}" title="{{{ $title }}}" class="tip-bottom"><i class="fa fa-trash-o"></i>{{{ $title }}}</a>

@stop
@section('formtitle')
<span class="icon"><i class="fa fa-user"></i></span>
<h5>{{{ $title }}}</h5>
@stop
{{-- Content --}}
@section('formcontent')
	<!-- Tabs -->
    {{-- Delete User Form --}}
    <form class="form-horizontal" method="post" action="" autocomplete="off">
        <!-- CSRF Token -->
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
        <input type="hidden" name="id" value="{{ $user->id }}" />
        <!-- ./ csrf token -->
	<p> Are you sure you want to delete the following user ?</p>
			<div class="form-group {{{ $errors->has('roles') ? 'error' : '' }}}">
        <!-- Form Actions -->
	<div class="form-actions">
		    <button type="submit" class="btn btn-danger">Delete</button>
		    <button type="button" class="btn">Cancel</button>
	</div>
        <!-- ./ form actions -->
    </form>
		<!-- ./ form actions -->
@stop
