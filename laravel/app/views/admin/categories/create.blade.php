@extends('admin.layouts.modal')
{{-- Breadcrumbs --}}
@section('breadcrumb')
	 @parent
	 <a href="{{{ URL::to('admin/categories') }}}" title="Manage users" class="tip-bottom"><i class="fa fa-user"></i>categories</a>
	 <a href="{{{ URL::to('admin/categories/create') }}}" title="{{{ $title }}}" class="tip-bottom"><i class="fa fa-edit"></i>{{{ $title }}}</a>

@stop
@section('formtitle')
<span class="icon"><i class="fa fa-user"></i></span>
<h5>{{{ $title }}}</h5>
@stop

{{-- Content --}}
@section('formcontent')
{{-- Create category Form --}}
<form class="form-horizontal" method="post" action="" autocomplete="off">
  <!-- CSRF Token -->
  <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
  <!-- ./ csrf token -->
  <!-- Name -->
  <div class="form-group {{{ $errors->has('name') ? 'error' : '' }}}">
    <label class="col-md-2 control-label" for="name">Name</label>
    <div class="col-md-10">
    <input class="form-control" type="text" name="name" id="name" value="{{{ Input::old('name') }}}" />
    {{ $errors->first('name', '<span class="help-inline">:message</span>') }}
    </div>
  </div>
  <!-- ./ name -->
  <div class="form-group">
    <label class="col-sm-3 col-md-3 col-lg-2 control-label">Permissions</label>
    <div class="col-sm-9 col-md-9 col-lg-10">
        @foreach ($permissions as $permission)
        <label class="">
          <input class="control-label" type="hidden" id="permissions[{{{ $permission['id'] }}}]" name="permissions[{{{ $permission['id'] }}}]" value="0" />
          <input type="checkbox" id="" value="0" name="" />
          {{{ $permission['display_name'] }}}
        </label>
        @endforeach
    </div>
      <label>
      </label>
  </div>

<!-- Form Actions -->
  <div class="form-actions">
        <button type="submit" class="btn btn-success">Save changes</button>
        <button type="button" class="btn">Cancel</button>
        <button type="reset" class="btn btn-default">Reset</button>
  </div>
<!-- ./ form actions -->
</form>
@stop
