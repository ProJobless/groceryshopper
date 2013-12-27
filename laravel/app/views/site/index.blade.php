@extends('site.layouts.default')
	<body>
		<!-- To make sticky footer need to wrap in a div -->
		<div id="wrap">
		<!-- Navbar -->
		<div class="navbar navbar-default navbar-inverse navbar-fixed-top">
			 <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav">
						<li {{ (Request::is('/') ? ' class="active"' : '') }}><a href="{{{ URL::to('') }}}">Home</a></li>
					</ul>

                    <ul class="nav navbar-nav pull-right">
                        @if (Auth::check())
                        @if (Auth::user()->hasRole('admin'))
                        <li><a href="{{{ URL::to('admin') }}}">Admin Panel</a></li>
                        @endif
                        <li><a href="{{{ URL::to('user') }}}">Logged in as {{{ Auth::user()->username }}}</a></li>
                        <li><a href="{{{ URL::to('user/logout') }}}">Logout</a></li>
                        @else
                        <li {{ (Request::is('user/login') ? ' class="active"' : '') }}><a href="{{{ URL::to('user/login') }}}">Login</a></li>
                        <li {{ (Request::is('user/register') ? ' class="active"' : '') }}><a href="{{{ URL::to('user/create') }}}">{{{ Lang::get('site.sign_up') }}}</a></li>
                        @endif
                    </ul>
					<!-- ./ nav-collapse -->
				</div>
			</div>
		</div>
		<!-- ./ navbar -->

		<!-- Container -->
		<div class="container">
			<!-- Notifications -->
			@include('notifications')
			<!-- ./ notifications -->

			<!-- Content -->
			@yield('content')
			<!-- ./ content -->
		</div>
		<!-- ./ container -->

		<!-- the following div is needed to make a sticky footer -->
		<div id="push"></div>
		</div>
		<!-- ./wrap -->


	    <div id="footer">
	      <div class="container">
	      </div>
	    </div>

      <!-- Shopping cart Modal -->
     <div class="modal fade" id="shoppingcart" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       <div class="modal-dialog">
         <div class="modal-content">
           <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
             <h4 class="modal-title">Shopping Cart</h4>
           </div>
           <div class="modal-body">
           
            <!-- Items table -->
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Quantity</th>
                  <th>Price</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><a href="single-item.html">HTC One</a></td>
                  <td>2</td>
                  <td>$250</td>
                </tr>
                <tr>
                  <td><a href="single-item.html">Apple iPhone</a></td>
                  <td>1</td>
                  <td>$502</td>
                </tr>
                <tr>
                  <td><a href="single-item.html">Galaxy Note</a></td>
                  <td>4</td>
                  <td>$1303</td>
                </tr>
                <tr>
                  <th></th>
                  <th>Total</th>
                  <th>$2405</th>
                </tr>
              </tbody>
            </table>
            
           </div>
           <div class="modal-footer">
             <button type="button" class="btn btn-default" data-dismiss="modal">Continue Shopping</button>
             <button type="button" class="btn btn-info">Checkout</button>
           </div>
         </div><!-- /.modal-content -->
       </div><!-- /.modal-dialog -->
     </div><!-- /.modal -->
           
      <!-- Logo & Navigation starts -->
      
      <div class="header">
         <div class="container">
            <div class="row">
               <div class="col-md-2 col-sm-2">
                  <!-- Logo -->
                  <div class="logo">
                     <h1><a href="index.html">OlsonKart</a></h1>
                  </div>
               </div>
               <div class="col-md-6 col-sm-5">
                  <!-- Navigation menu -->
						<div class="navi">
							<div id="ddtopmenubar" class="mattblackmenu">
								<ul>
									<li><a href="index.html">Home</a></li>
                           <li><a href="#" rel="ddsubmenu1">Account</a>
										<ul id="ddsubmenu1" class="ddsubmenustyle">
                                 <li><a href="account.html">My Account</a></li>
											<li><a href="viewcart.html">View Cart</a></li>
                                 <li><a href="checkout.html">Checkout</a></li>
                                 <li><a href="wishlist.html">Wish List</a></li>
                                 <li><a href="orderhistory.html">Order History</a></li>
                                 <li><a href="editprofile.html">Edit Profile</a></li>
											<li><a href="confirmation.html">Confirmation</a></li>
										</ul>
									</li>
									<li><a href="#" rel="ddsubmenu1">Pages</a>
										<ul id="ddsubmenu1" class="ddsubmenustyle">
											<li><a href="404.html">404</a></li>
                                 <li><a href="faq.html">FAQ</a></li>
                                 <li><a href="blog.html">Blog</a></li>
											<li><a href="careers.html">Careers</a>
                                 <li><a href="support.html">Support</a></li>
                                 <li><a href="aboutus.html">About</a></li>
										</ul>
									</li>
									<li><a href="#" rel="ddsubmenu1">Computers</a>
										<ul id="ddsubmenu1" class="ddsubmenustyle">
											<li><a href="items.html">Desktop</a></li>
                                 <li><a href="items.html">Laptop</a></li>
                                 <li><a href="items.html">NetBook</a></li>
											<li><a href="items.html">All-In-One PC</a>
                                 <li><a href="items.html">Alienware</a></li>
										</ul>
									</li>                       
									<li><a href="contactus.html">Contact</a></li>
								</ul>
							</div>
						</div>

						<!-- Dropdown NavBar -->
                  <div class="navis"></div>                  
                  
               </div>
               
               <div class="col-md-4 col-sm-5">
                  <div class="kart-links">
                     <a href="login.html">Login</a> 
                     <a href="register.html">Signup</a>
                     <a data-toggle="modal" href="#shoppingcart"><i class="icon-shopping-cart"></i> 3 Items - $300</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
      
      <!-- Logo & Navigation ends -->
     
      <!-- Page title -->
      <div class="page-title">
         <div class="container">
            <h2><i class="icon-desktop color"></i> Page Title <small>Subtext for header</small></h2>
            <hr />
         </div>
      </div>
      <!-- Page title -->
      
      <!-- Page content -->
      
      <div class="page-content blocky">
         <div class="container">
            
         </div>
      </div>
     
      
      <!-- Recent posts CarouFredSel Starts -->
	
      <div class="recent-posts blocky">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <!-- Section title -->
                  <div class="section-title">
                     <h4><i class="icon-desktop color"></i> &nbsp;Whats New in Our Company</h4>
                  </div>    
                  
                  <div class="row">
                     <div class="col-md-12">
                        <div class="my_carousel">
                        
                           <div class="carousel_nav pull-right">
                               <!-- Carousel navigation -->
                               <a class="prev" id="car_prev" href="#"><i class="icon-chevron-left"></i></a>
                               <a class="next" id="car_next" href="#"><i class="icon-chevron-right"></i></a>
                           </div>
                          
                           <ul id="carousel_container">
                              <!-- Carousel item -->
                              <li>
                                 <a href="#"><img src="img/items/2.png" alt="" class="img-responsive"/></a>
                                 <div class="carousel_caption">
                                    <h5><a href="#">Duis estsum placerat</a></h5>
                                    <p>Something about the product goes here. Not More than 2 lines.</p>
                                    <a href="#" class="btn btn-info btn-sm"><i class="icon-shopping-cart"></i> Buy for $199</a>
                                 </div>
                              </li>
                              <li>
                                 <a href="#"><img src="img/items/3.png" alt="" class="img-responsive"/></a>
                                 <div class="carousel_caption">
                                     <h5><a href="#">Maecenas estsum odio</a></h5>
                                     <p>Something about the product goes here. Not More than 2 lines.</p>
                                     <a href="#" class="btn btn-info btn-sm"><i class="icon-shopping-cart"></i> Buy for $199</a>
                                 </div>
                              </li>
                              <li>
                                 <a href="#"><img src="img/items/4.png" alt="" class="img-responsive"/></a>
                                 <div class="carousel_caption">
                                     <h5><a href="#">Proin estsum accumsan</a></h5>
                                     <p>Something about the product goes here. Not More than 2 lines.</p>
                                     <a href="#" class="btn btn-info btn-sm"><i class="icon-shopping-cart"></i> Buy for $199</a>
                                 </div>
                              </li>
                              <li>
                                 <a href="#"><img src="img/items/5.png" alt="" class="img-responsive"/></a>
                                 <div class="carousel_caption">
                                     <h5><a href="#">Lorem estsum ipsum</a></h5>
                                     <p>Something about the product goes here. Not More than 2 lines.</p>
                                     <a href="#" class="btn btn-info btn-sm"><i class="icon-shopping-cart"></i> Buy for $199</a>
                                 </div>
                              </li>
                              <li>
                                 <a href="#"><img src="img/items/6.png" alt="" class="img-responsive"/></a>
                                 <div class="carousel_caption">
                                     <h5><a href="#">Praesent estsum massa</a></h5>
                                     <p>Something about the product goes here. Not More than 2 lines.</p>
                                     <a href="#" class="btn btn-info btn-sm"><i class="icon-shopping-cart"></i> Buy for $199</a>
                                 </div>
                              </li>
                              <li>
                                 <a href="#"><img src="img/items/7.png" alt="" class="img-responsive"/></a>
                                 <div class="carousel_caption">
                                     <h5><a href="#">Praesent estsum etium</a></h5>
                                     <p>Something about the product goes here. Not More than 2 lines.</p>
                                     <a href="#" class="btn btn-info btn-sm"><i class="icon-shopping-cart"></i> Buy for $199</a>
                                 </div>
                              </li>
                           </ul>
                           <div class="clearfix"></div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
			
      <!-- Recent posts Ends -->	
      
      
      <!-- Catchy starts -->
      <div class="catchy blocky">
         <div class="catchy-inner1">
            <div class="catchy-inner2">
               <div class="container">
                  <div class="row">
                     <div class="col-md-5">
                        <div class="catchy-subscribe">
                           <h3>Join Us!</h3>
                           <p>Lorem tristique est sit amet diam ipsum  dolor sit  diam interdum diam ipsum  dolor sit diam ipsum  dolor sit tristique semper.</p>
                           <br />
                           <form class="form-inline" role="form">
                             <div class="form-group">
                               <input type="text" class="form-control " id="exampleInputEmail2" placeholder="Enter your email">
                             </div>
                             <button type="submit" class="btn btn-danger">Subscribe</button>
                           </form>

                        </div>
                     </div>
                     <div class="col-md-7">
                     
                        <div class="report">
                           <div class="report-bor">
                              <div class="row">
                                 <!-- Report data starts -->
                                 <div class="col-md-4 col-sm-4">
                                    <div class="report-data">
                                       <div class="row">
                                          <div class="col-md-4 col-sm-4 col-xs-4">
                                             <!-- Icon -->
                                             <div class="report-icon">
                                                <i class="icon-group color"></i>
                                             </div>
                                          </div>
                                          <div class="col-md-8 col-md-8 col-xs-8">
                                             <!-- Details -->
                                             <span class="report-big color">40,000</span> <span>Customers</span>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- Report data ends -->
                                 
                                 <!-- Report data starts -->
                                 <div class="col-md-4 col-sm-4">
                                    <div class="report-data">
                                       <div class="row">
                                          <div class="col-md-4 col-sm-4 col-xs-4">
                                             <!-- Icon -->
                                             <div class="report-icon">
                                                <i class="icon-calendar color"></i>
                                             </div>
                                          </div>
                                          <div class="col-md-8 col-md-8 col-xs-8">
                                             <!-- Details -->
                                              <span>Since</span><span class="report-big color">1857</span>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- Report data ends -->

                                 <!-- Report data starts -->
                                 <div class="col-md-4 col-sm-4">
                                    <div class="report-data">
                                       <div class="row">
                                          <div class="col-md-4 col-sm-4 col-xs-4">
                                             <!-- Icon -->
                                             <div class="report-icon">
                                                <i class="icon-android color"></i>
                                             </div>
                                          </div>
                                          <div class="col-md-8 col-md-8 col-xs-8">
                                             <!-- Details -->
                                             <span class="report-big color">30,000</span> <span>Revenue</span>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- Report data ends -->
                                 
                              </div>
                              
                              <hr class="hidden-xs">
                              
                              <div class="row">
                                 
                                 <!-- Report data starts -->
                                 <div class="col-md-4 col-sm-4">
                                    <div class="report-data">
                                       <div class="row">
                                          <div class="col-md-4 col-sm-4 col-xs-4">
                                             <!-- Icon -->
                                             <div class="report-icon">
                                                <i class="icon-building color"></i>
                                             </div>
                                          </div>
                                          <div class="col-md-8 col-md-8 col-xs-8">
                                             <!-- Details -->
                                             <span class="report-big color">150 +</span> <span>Companies</span>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- Report data ends -->
                                 
                                 <!-- Report data starts -->
                                 <div class="col-md-4 col-sm-4">
                                    <div class="report-data">
                                       <div class="row">
                                          <div class="col-md-4 col-sm-4 col-xs-4">
                                             <!-- Icon -->
                                             <div class="report-icon">
                                                <i class="icon-signal color"></i>
                                             </div>
                                          </div>
                                          <div class="col-md-8 col-md-8 col-xs-8">
                                             <!-- Details -->
                                             <span class="report-big color">50.60%</span> <span>Growth</span>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- Report data ends -->

                                 <!-- Report data starts -->
                                 <div class="col-md-4 col-sm-4">
                                    <div class="report-data">
                                       <div class="row">
                                          <div class="col-md-4 col-sm-4 col-xs-4">
                                             <!-- Icon -->
                                             <div class="report-icon">
                                                <i class="icon-truck color"></i>
                                             </div>
                                          </div>
                                          <div class="col-md-8 col-md-8 col-xs-8">
                                             <!-- Details -->
                                             <span class="report-big color">100 +</span> <span>Employees</span>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- Report data ends -->
                                 
                              </div>
                              
                           </div>
                        </div> 
                     
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>      
      <!-- Catchy ends -->
      
      <!-- CTA Starts -->
      <div class="blocky">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="cta">
                     <div class="row">
                        <div class="col-md-8 col-sm-8">
                           <h5><i class="icon-angle-right"></i> Lorem trist iquest <span class="color">siamet diam</span> ipsum dolor sitamt</h5>
                        </div>
                        <div class="col-md-4 col-sm-4">
                           <div class="cta-buttons pull-right">
                              <a href="#" class="btn btn-info btn-lg">Download</a> &nbsp; <a href="#" class="btn btn-danger btn-lg">Get It Now</a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>               
            </div>
         </div>
      </div>
      <!-- CTA Ends -->
      
      <!-- Footer starts -->
      <footer>
         <div class="container">
         
               <div class="row">

                        <div class="col-md-4 col-sm-4">
                           <div class="fwidget">
                           
                              <h4>Oslon de<span class="color">'</span> Techno</h4>
                              <hr />
                              <p>Duis leo risus, vehicula luctus nunc.  Quiue rhoncus, a sodales enim arcu quis turpis. Duis leo risus, condimentum ut posuere ac, vehicula luctus nunc.  Quisque rhoncus, a sodales enim arcu quis turpis.</p>
                              
                              <div class="social">
                                 <a href="#" class="facebook"><i class="icon-facebook"></i></a>
                                 <a href="#" class="twitter"><i class="icon-twitter"></i></a>
                                 <a href="#" class="google-plus"><i class="icon-google-plus"></i></a>
                                 <a href="#" class="linkedin"><i class="icon-linkedin"></i></a>
                                 <a href="#" class="pinterest"><i class="icon-pinterest"></i></a>
                              </div>
                           </div>
                       </div>

                       <div class="col-md-4 col-sm-4">
                         <div class="fwidget">
                           <h4>Categories</h4>
                           <hr />
                           <ul>
                             <li><a href="#">Sed eu leo orci, condimentum gravida metus</a></li>
                             <li><a href="#">Etiam at nulla ipsum, in rhoncus purus</a></li>
                             <li><a href="#">Fusce vel magna faucibus felis dapibus facilisis</a></li>
                             <li><a href="#">Vivamus scelerisque dui in massa</a></li>
                             <li><a href="#">Pellentesque eget adipiscing dui semper</a></li>
                           </ul>
                         </div>
                       </div>        

                       

                       <div class="col-md-4 col-sm-4">
                         <div class="fwidget">
                           
                           <h4>Get In Touch</h4>
                           <hr />
                           <div class="address">
                              <p><i class="icon-home color contact-icon"></i> #12, Plot No.14, Raj Karmara Street, </p>
                              <p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 5th Stage, Koramangala, Madiwala,</p>
                              <p> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Bangalore - 493922, Karananana.</p>
                              <p><i class="icon-phone color contact-icon"></i> +94-948-323-5532</p>
                              <p><i class="icon-envelope color contact-icon"></i> <a href="mailto:something@gmail.com">some.thing@gmail.com</a></p>
                           </div>
                           
                         </div>
                       </div>

                     </div>

         
         
            <hr />
            
            <div class="copy text-center">
               Copyright 2013 &copy; - <a href="http://responsivewebinc.com/bootstrap-themes">Bootstrap Themes</a>
            </div>
         </div>
      </footer>
      <!-- Footer ends -->
      
      <!-- Scroll to top -->
      <span class="totop"><a href="#"><i class="icon-chevron-up"></i></a></span> 
      
