@extends('admin.layouts.modal')

{{-- Content --}}
@section('formcontent')
	<!-- Tabs -->
	{{-- Create User Form --}}
	<form class="form-horizontal" method="post" action="@if (isset($user)){{ URL::to('admin/users/' . $user->id . '/edit') }}@endif" autocomplete="off" novalidate="novalidate">
                <div class="modal-body">
			<!-- CSRF Token -->
			<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
			<!-- ./ csrf token -->

			<!-- Tabs Content -->
			<div class="tab-content">
				<!-- General tab -->
				<div class="tab-pane active" id="tab-general">
					<!-- username -->
					<div class="form-group {{{ $errors->has('username') ? 'has-error' : '' }}}">
						<label class="col-sm-3 col-md-3 col-lg-2 control-label" for="username">Username</label>
						<div class="col-sm-9 col-md-9 col-lg-10">
							<input class="form-control input-sm" type="text" name="username" id="username" value="{{{ Input::old('username', isset($user) ? $user->username : null) }}}" />
							{{{ $errors->first('username', '<span class="help-block text-left">:message</span>') }}}
						</div>
					</div>
					<!-- ./ username -->

					<!-- Email -->
					<div class="form-group {{{ $errors->has('email') ? 'has-error' : '' }}}">
						<label class="col-md-2 control-label" for="email">Email</label>
						<div class="col-md-10">
							<input class="form-control" type="text" name="email" id="email" value="{{{ Input::old('email', isset($user) ? $user->email : null) }}}" />
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
								<select class="form-control" {{{ ($user->id === Confide::user()->id ? ' disabled="disabled"' : '') }}} name="confirm" id="confirm">
									<option value="1"{{{ ($user->confirmed ? ' selected="selected"' : '') }}}>{{{ Lang::get('general.yes') }}}</option>
									<option value="0"{{{ ( ! $user->confirmed ? ' selected="selected"' : '') }}}>{{{ Lang::get('general.no') }}}</option>
								</select>
							@endif
							{{{ $errors->first('confirm', '<span class="help-inline">:message</span>') }}}
						</div>
					</div>
					<!-- ./ activation status -->

					<!-- Groups -->
					<div class="form-group {{{ $errors->has('roles') ? 'error' : '' }}}">
				<label class="col-md-2 control-label" for="roles">Roles</label>
				<div class="col-md-6">
					<select class="form-control" name="roles[]" id="roles[]" multiple>
						@foreach ($roles as $role)
										@if ($mode == 'create')
								<option value="{{{ $role->id }}}"{{{ ( in_array($role->id, $selectedRoles) ? ' selected="selected"' : '') }}}>{{{ $role->name }}}</option>
							@else
											<option value="{{{ $role->id }}}"{{{ ( array_search($role->id, $user->currentRoleIds()) !== false && array_search($role->id, $user->currentRoleIds()) >= 0 ? ' selected="selected"' : '') }}}>{{{ $role->name }}}</option>
										@endif
						@endforeach
							</select>

							<span class="help-block">
								Select a group to assign to the user, remember that a user takes on the permissions of the group they are assigned.
							</span>
				</div>
					</div>
					<!-- ./ groups -->
				</div>
				<!-- ./ general tab -->

			</div>
			<!-- ./ tabs content -->
                </div>
                <div class="modal-footer">
                    <div class="btn-group">
			    <button type="reset" class="btn btn-default" data-dismiss="modal">Reset</button>
			    <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
	</form>
		<!-- ./ form actions -->
@stop
