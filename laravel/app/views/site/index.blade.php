@extends('site.layouts.default')
@section('content')


      <!-- Hero starts -->

      <div class="hero">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <!-- Catchy title -->
                  <h3>Find your groceries.  Fast!!<span class="color"></span></h3>
               </div>
            </div>
         </div>
      </div>
	  <!-- Hero ends -->
		<div class="blocky">
		 <div class="container center-block">
			<div class="row">
			   <div class="col-md-10 col-md-offset-1">
									<form class="form-inline widget-search" role="search">
											<div class="form-group">
												 <div class="input-group custom-search-form">
													  <input type="text" class="form-control" placeholder="Search">
													  <span class="input-group-btn">
													  <button class="btn btn-info" type="submit">
													  <span class="glyphicon glyphicon-search"></span>Search

													 </button>
													 </span>
													 </div><!-- /input-group -->
												</div>
									</form>
			   </div>               
			</div>
		 </div>
		</div>

@stop
