@extends('site.layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ Lang::get('user/user.login') }}} ::
@parent
@stop

{{-- Content --}}
@section('content')
      <div class="page-title">
         <div class="container">
            <h2><i class="icon-desktop color"></i> Login <small> </small></h2>
            <hr>
         </div>
      </div>
      <div class="blocky">
         <div class="container">
            <div class="row">
               <div class="col-md-6">
                  <div class="reg-login-info">
                     <h2>Login to Access Amazing Benefits <span class="color">!!!</span></h2>
                     <p>Duis leo risus, vehicula luctus nunc. Quiue rhoncus, a sodales enim arcu quis turpis. Duis leo risus, condimentum ut posuere ac, vehicula luctus nunc. Quisque rhoncus, a sodales enim arcu quis turpis.</p>
                  </div>
                        <div class="catchy-subscribe">
                           <h3>Don't have an account yet? Register!</h3>
                           <p>Lorem tristique est sit amet diam ipsum  dolor sit  diam interdum diam ipsum  dolor sit diam ipsum  dolor sit tristique semper.</p>
                           <br />
                           <form class="form-inline" role="form" action="{{{ URL::to('user/create') }}}">
                             <div class="form-group">
                               <input type="text" class="form-control " id="exampleInputEmail2" placeholder="Enter your email">
                             </div>
                             <button type="submit" class="btn btn-danger">Sign in</button>
                           </form>

                        </div>

               </div>
               <div class="col-md-6">
                  <div class="register-login">
                     <div class="cool-block">
                        <div class="cool-block-bor">
                        
                           <h3>Login</h3>
	<form class="form-horizontal" method="POST" action="{{ URL::to('user/login') }}" accept-charset="UTF-8">
	    <input type="hidden" name="_token" value="{{ csrf_token() }}">
	    <fieldset>
		<div class="form-group">
		    <label class="col-md-2 control-label" for="email">{{ Lang::get('confide::confide.username_e_mail') }}</label>
		    <div class="col-md-10">
			<input class="form-control" tabindex="1" placeholder="{{ Lang::get('confide::confide.username_e_mail') }}" type="text" name="email" id="email" value="{{ Input::old('email') }}">
		    </div>
		</div>
		<div class="form-group">
		    <label class="col-md-2 control-label" for="password">
			{{ Lang::get('confide::confide.password') }}
		    </label>
		    <div class="col-md-10">
			<input class="form-control" tabindex="2" placeholder="{{ Lang::get('confide::confide.password') }}" type="password" name="password" id="password">
		    </div>
		</div>

		<div class="form-group">
		    <div class="col-md-offset-2 col-md-10">
			<div class="checkbox">
			    <label for="remember">{{ Lang::get('confide::confide.login.remember') }}
				<input type="hidden" name="remember" value="0">
				<input tabindex="4" type="checkbox" name="remember" id="remember" value="1">
			    </label>
			</div>
		    </div>
		</div>

		@if ( Session::get('error') )
		<div class="alert alert-danger">{{ Session::get('error') }}</div>
		@endif

		@if ( Session::get('notice') )
		<div class="alert">{{ Session::get('notice') }}</div>
		@endif

		<div class="form-group">
		    <div class="col-md-offset-2 col-md-10">
			<button tabindex="3" type="submit" class="btn btn-primary">{{ Lang::get('confide::confide.login.submit') }}</button>
			<a class="btn btn-default" href="forgot">{{ Lang::get('confide::confide.login.forgot_password') }}</a>
		    </div>
		</div>
	    </fieldset>
	</form>
                           
                        </div>
                     </div>   
                  </div>
               </div>
            </div>
            <div class="sep-bor"></div>
         </div>
      </div>
     

@stop
