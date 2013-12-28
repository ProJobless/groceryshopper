@extends('site.user.default')
{{-- Web site Title --}}
@section('user-account-title')
		My Account <small>Edit your profile</small></h2>
@parent
@stop
{{-- Content --}}
@section('user-content')
        <h3><i class="icon-user color"></i> &nbsp;Edit Profile</h3>
                  <!-- Your details -->
	<form class="form-horizontal" method="post"
		 action="{{ URL::to('user/' . $user->id . '/edit') }}"  autocomplete="off">
	    <!-- CSRF Token -->
	    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
	    <!-- ./ csrf token -->
	    <!-- General tab -->
	    <div class="tab-pane active" id="tab-general">
		<!-- username -->
		<div class="form-group {{{ $errors->has('username') ? 'error' : '' }}}">
		    <label class="col-md-2 control-label" for="username">Username</label>
		    <div class="col-md-5">
			<input class="form-control" type="text" name="username" id="username" value="{{{ Input::old('username', $user->username) }}}" />
			{{{ $errors->first('username', '<span class="help-inline">:message</span>') }}}
		    </div>
		</div>
		<!-- ./ username -->

		<!-- Email -->
		<div class="form-group {{{ $errors->has('email') ? 'error' : '' }}}">
		    <label class="col-md-2 control-label" for="email">Email</label>
		    <div class="col-md-5">
			<input class="form-control" type="text" name="email" id="email" value="{{{ Input::old('email', $user->email) }}}" />
			{{{ $errors->first('email', '<span class="help-inline">:message</span>') }}}
		    </div>
		</div>
		<!-- ./ email -->

		<!-- Password -->
		<div class="form-group {{{ $errors->has('password') ? 'error' : '' }}}">
		    <label class="col-md-2 control-label" for="password">Password</label>
		    <div class="col-md-5">
			<input class="form-control" type="password" name="password" id="password" value="" />
			{{{ $errors->first('password', '<span class="help-inline">:message</span>') }}}
		    </div>
		</div>
		<!-- ./ password -->

		<!-- Password Confirm -->
		<div class="form-group {{{ $errors->has('password_confirmation') ? 'error' : '' }}}">
		    <label class="col-md-2 control-label" for="password_confirmation">Password Confirm</label>
		    <div class="col-md-5">
			<input class="form-control" type="password" name="password_confirmation" id="password_confirmation" value="" />
			{{{ $errors->first('password_confirmation', '<span class="help-inline">:message</span>') }}}
		    </div>
		</div>
		<!-- ./ password confirm -->
	    </div>
	    <!-- ./ general tab -->
	    <hr />
	    <!-- Form Actions -->
	    <div class="form-group">
		<div class="col-md-offset-2 col-md-5">
		    <button type="submit" class="btn btn-success">Update</button>
		</div>
	    </div>
	    <!-- ./ form actions -->
	</form>
<table class="table table-striped">
    <thead>
    <tr>
        <th>#</th>
        <th>Username</th>
        <th>Signed Up</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>{{{$user->id}}}</td>
        <td>{{{$user->username}}}</td>
        <td>{{{$user->joined()}}}</td>
    </tr>
    </tbody>
</table>
@stop
