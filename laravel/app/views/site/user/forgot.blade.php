@extends('site.layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ Lang::get('user/user.forgot_password') }}} ::
@parent
@stop

{{-- Content --}}
@section('content')
      <div class="page-title">
         <div class="container">
            <h2><i class="icon-desktop color"></i> Forgot password <small> </small></h2>
            <hr>
         </div>
      </div>
      <div class="blocky">
         <div class="container">
            <div class="row">
               <div class="col-md-6">
                  <div class="reg-login-info">
						 <h2>Forgot your account password<span class="color">!!!</span></h2>
						 <p>You can reset your password easily. Enter the email you used to register an account and a new password will be emailed to you.</p>
				  </div>
               </div>
			   <div class="col-md-6">
					   <div class="reg-login-info">
							  <div class="cool-block">
									<div class="cool-block-bor">
								<h2>{{{ Lang::get('user/user.forgot_password') }}}</h2>
								{{ Confide::makeForgotPasswordForm() }}
						  		</div>
						</div></div><!-- reg-login -->
	       </div><!-- col-md-6 -->
         </div><!-- row -->
         <div class="sep-bor"></div>
        </div>
      </div>
@stop
