@extends('admin.layouts.modal')
{{-- Breadcrumbs --}}
@section('breadcrumb')
	 @parent
	 <a href="{{{ URL::to('admin/groceryitems') }}}" title="Manage grocery items" class="tip-bottom"><i class="fa fa-user"></i>Grocery items</a>
	 <a href="{{{ URL::to('admin/groceryitems/' . (isset($groceryitem) ? $groceryitem->id.'/edit' : 'create') ) }}}" title="{{{ $title }}}" class="tip-bottom"><i class="fa fa-edit"></i>{{{ $title }}}</a>

@stop
@section('formtitle')
<span class="icon"><i class="fa fa-user"></i></span>
<h5>{{{ $title }}}</h5>
@stop

{{-- Content --}}
@section('formcontent')
	<!-- Tabs -->
	{{-- Create User Form --}}
	<form class="form-horizontal" method="post" action="@if (isset($groceryitem)){{ URL::to('admin/groceryitems/' . $groceryitem->id . '/edit') }}@endif" autocomplete="off" novalidate="novalidate">
			<!-- CSRF Token -->
			<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
      <!-- ./ csrf token -->

			<!-- product_name -->
			<div class="form-group {{{ $errors->has('product_name') ? 'has-error' : '' }}}">
				<label class="col-sm-3 col-md-3 col-lg-2 control-label" for="product_name">product_name</label>
				<div class="col-sm-9 col-md-9 col-lg-10">
					<input class="form-control input-sm" type="text" name="product_name" id="product_name" value="{{{ Input::old('product_name', isset($groceryitem) ? $groceryitem->product_name : null) }}}" />
					{{{ $errors->first('product_name', '<span class="help-block text-left">:message</span>') }}}
				</div>
			</div>
			<!-- ./ product_name -->

			<!-- manufacturer -->
			<div class="form-group {{{ $errors->has('manufacturer') ? 'has-error' : '' }}}">
				<label class="col-md-2 control-label" for="manufacturer">manufacturer</label>
				<div class="col-md-10">
					<input class="form-control" type="text" name="manufacturer" id="manufacturer" value="{{{ Input::old('manufacturer', isset($groceryitem) ? $groceryitem->manufacturer : null) }}}" />
					{{{ $errors->first('manufacturer', '<span class="help-inline">:message</span>') }}}
				</div>
			</div>
			<!-- ./ manufacturer -->


			<!-- brand -->
			<div class="form-group {{{ $errors->has('brand') ? 'has-error' : '' }}}">
				<label class="col-md-2 control-label" for="brand">brand</label>
				<div class="col-md-10">
					<input class="form-control" type="text" name="brand" id="brand" value="{{{ Input::old('brand', isset($groceryitem) ? $groceryitem->brand : null) }}}" />
					{{{ $errors->first('brand', '<span class="help-inline">:message</span>') }}}
				</div>
			</div>
			<!-- ./ brand -->


			<!-- size -->
			<div class="form-group {{{ $errors->has('size') ? 'has-error' : '' }}}">
				<label class="col-md-2 control-label" for="size">size</label>
				<div class="col-md-10">
					<input class="form-control" type="text" name="size" id="size" value="{{{ Input::old('size', isset($groceryitem) ? $groceryitem->size : null) }}}" />
					{{{ $errors->first('size', '<span class="help-inline">:message</span>') }}}
				</div>
			</div>
			<!-- ./ size -->


			<!-- upc code -->
			<div class="form-group {{{ $errors->has('upc') ? 'has-error' : '' }}}">
				<label class="col-md-2 control-label" for="upc">upc</label>
				<div class="col-md-10">
					<input class="form-control" type="text" name="upc" id="upc" value="{{{ Input::old('upc', isset($groceryitem) ? $groceryitem->upc : null) }}}" />
					{{{ $errors->first('upc', '<span class="help-inline">:message</span>') }}}
				</div>
			</div>
			<!-- ./ upc -->


			<!-- Email -->
			<div class="form-group {{{ $errors->has('email') ? 'has-error' : '' }}}">
				<label class="col-md-2 control-label" for="email">Email</label>
				<div class="col-md-10">
					<input class="form-control" type="text" name="email" id="email" value="{{{ Input::old('email', isset($groceryitem) ? $groceryitem->email : null) }}}" />
					{{{ $errors->first('email', '<span class="help-inline">:message</span>') }}}
				</div>
			</div>
			<!-- ./ email -->

			<!-- Password -->
			<div class="form-group {{{ $errors->has('password') ? 'error' : '' }}}">
				<label class="col-md-2 control-label" for="password">Password</label>
				<div class="col-md-10">
					<input class="form-control" type="password" name="password" id="password" value="" />
					{{{ $errors->first('password', '<span class="help-inline">:message</span>') }}}
				</div>
			</div>
			<!-- ./ password -->

			<!-- Password Confirm -->
			<div class="form-group {{{ $errors->has('password_confirmation') ? 'error' : '' }}}">
				<label class="col-md-2 control-label" for="password_confirmation">Password Confirm</label>
				<div class="col-md-10">
					<input class="form-control" type="password" name="password_confirmation" id="password_confirmation" value="" />
					{{{ $errors->first('password_confirmation', '<span class="help-inline">:message</span>') }}}
				</div>
			</div>
			<!-- ./ password confirm -->

			<!-- Activation Status -->
			<div class="form-group {{{ $errors->has('activated') || $errors->has('confirm') ? 'error' : '' }}}">
				<label class="col-md-2 control-label" for="confirm">Activate User?</label>
				<div class="col-md-6">
					@if ($mode == 'create')
						<select class="form-control" name="confirm" id="confirm">
							<option value="1"{{{ (Input::old('confirm', 0) === 1 ? ' selected="selected"' : '') }}}>{{{ Lang::get('general.yes') }}}</option>
							<option value="0"{{{ (Input::old('confirm', 0) === 0 ? ' selected="selected"' : '') }}}>{{{ Lang::get('general.no') }}}</option>
						</select>
					@else
						<select class="form-control" {{{ ($groceryitem->id === Confide::user()->id ? ' disabled="disabled"' : '') }}} name="confirm" id="confirm">
							<option value="1"{{{ ($groceryitem->confirmed ? ' selected="selected"' : '') }}}>{{{ Lang::get('general.yes') }}}</option>
							<option value="0"{{{ ( ! $groceryitem->confirmed ? ' selected="selected"' : '') }}}>{{{ Lang::get('general.no') }}}</option>
						</select>
					@endif
					{{{ $errors->first('confirm', '<span class="help-inline">:message</span>') }}}
				</div>
			</div>
			<!-- ./ activation status -->

			<!-- List of stores -->
			<div class="form-group {{{ $errors->has('stores') ? 'error' : '' }}}">
				<label class="col-md-2 control-label" for="stores">stores</label>
				<div class="col-md-6">
					<select class="form-control" name="stores[]" id="stores[]" multiple>
					</select>
					<span class="help-block">
						Select a group to assign to the user, remember that a user takes on the permissions of the group they are assigned.
					</span>
				</div>
			</div>
      <!-- ./ stores -->


		<!-- Form Actions -->
			<div class="form-actions">
				    <button type="submit" class="btn btn-primary">Save changes</button>
				    <button type="button" class="btn">Cancel</button>
				    <button type="reset" class="btn btn-default">Reset</button>
			</div>
	</form>
		<!-- ./ form actions -->
@stop
