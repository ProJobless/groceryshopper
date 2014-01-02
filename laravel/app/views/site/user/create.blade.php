@extends('site.layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ Lang::get('user/user.register') }}} ::
@parent
@stop

{{-- Content --}}
@section('content')
<div class="blocky">
 <div class="container">
    <div class="row">
       <div class="col-md-6">
	  <div class="reg-login-info">
	     <h2>Register  to Access Amazing stuff <span class="color">!!!</span></h2>
	     <p>Duis leo risus, vehicula luctus nunc. Quiue rhoncus, a sodales enim arcu quis turpis. Duis leo risus, condimentum ut posuere ac, vehicula luctus nunc. Quisque rhoncus, a sodales enim arcu quis turpis.</p>
	  </div>
       </div>
       <div class="col-md-6">
                  <div class="register-login">
                     <div class="cool-block">
                        <div class="cool-block-bor">
				<h2>Signup</h2>
					{{ Confide::makeSignupForm()->render() }}
			</div>
		      </div>
		  </div>
	</div>
    </div>
</div>
</div>
@stop
