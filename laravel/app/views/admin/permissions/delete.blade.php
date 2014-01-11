@extends('admin.layouts.modal')
{{-- Breadcrumbs --}}
@section('breadcrumb')
	 @parent
	 <a href="{{{ URL::to('admin/permissions') }}}" title="Manage permissions" class="tip-bottom"><i class="fa fa-user"></i>Permissions</a>
	 <a href="{{{ URL::to('admin/permissions/' .$permission->id . '/delete') }}}" title="{{{ $title }}}" class="tip-bottom"><i class="fa fa-trash-o"></i>{{{ $title }}}</a>

@stop
@section('formtitle')
<span class="icon"><i class="fa fa-user"></i></span>
<h5>{{{ $title }}}</h5>
@stop

{{-- Content --}}
@section('formcontent')

    {{-- Delete Role Form --}}
    <form class="form-horizontal" method="post" action="" autocomplete="off">
        <!-- CSRF Token -->
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
        <input type="hidden" name="id" value="{{ $permission->id }}" />
        <!-- ./ csrf token -->
	<p> Are you sure you want to delete the following permission?</p>
        <!-- Form Actions -->
	<div class="form-actions">
		    <button type="submit" class="btn btn-danger">Delete</button>
		    <button type="button" class="btn">Cancel</button>
	</div>
        <!-- ./ form actions -->
    </form>
@stop
