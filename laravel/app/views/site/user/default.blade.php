@extends('site.layouts.default')
{{-- Content --}}
@section('content')
<!-- Page title -->
<div class="page-title">
 <div class="container">
    <h2><i class="icon-user color"></i>
            @section('user-account-title')
            @show
    <hr />
 </div>
</div>
<!-- Page title -->
<!-- Page content -->
      <div class="account-content">
         <div class="container">
            
            <div class="row">
               <div class="col-md-3">
                  <div class="sidey">
			@include('site.user.user-navigation')
		  </div>
               </div>
               <div class="col-md-9">
        	@yield('user-content')
               </div>
            </div>

            <div class="sep-bor"></div>
         </div>

      </div>
@stop
