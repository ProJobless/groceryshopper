
<!-- Logo & Navigation starts -->

<div class="header">
    <div class="container">
    <div class="row">
        <div class="col-md-2 col-sm-2">
        <!-- Logo -->
                <div class="logo">
                {{ HTML::image('/assets/img/grocery_shopper_logo.png') }}
                </div>
        </div>
        <div class="col-md-6 col-sm-5">
            <!-- Navigation menu -->
            <div class="navi">
                <div id="ddtopmenubar" class="mattblackmenu">
                    <ul>
                        <li {{ (Request::is('/') ? ' class="active"' : '') }}><a href="{{{ URL::to('') }}}">Home</a></li>
                	@if (Auth::check())
                        <li><a href="#" rel="ddsubmenu1">Account</a>
                            <ul id="ddsubmenu1" class="ddsubmenustyle">
                                <li><a href="{{{ URL::to('user/grocery-list') }}}">Grocery list</a></li>
                                <li><a href="{{{ URL::to('user/view-cart') }}}">View Cart</a></li>
                                <li><a href="{{{ URL::to('user/order-history') }}}">Order History</a></li>
                                <li><a href="{{{ URL::to('user/settings') }}}">Edit Profile</a></li>
                                <li><a href="{{{ URL::to('user') }}}">My Account</a></li>
                                </ul>
                        </li>
                	@else
                        <li><a href="{{{ URL::to('user/login') }}}" >Your account</a>
                	@endif
                        <li><a href="#" rel="ddsubmenu1">Price Compare</a>
                            <ul id="ddsubmenu1" class="ddsubmenustyle">
                                <li><a href="404.html">Find local grocery stores</a></li>
                                <li><a href="faq.html">Flyers</a></li>
                            </ul>
                        </li>
                        <li><a href="{{{ URL::to('contact') }}}">Contact</a></li>
                        <li><a href="{{{ URL::to('contact') }}}">About</a></li>
                    </ul>
                </div>
            </div>
            <!-- Dropdown NavBar -->
            <div class="navis"></div>

            </div>
            <div class="col-md-4 col-sm-5">
              <div class="kart-links">
                @if (Auth::check())
                @if (Auth::user()->hasRole('administrator'))
                <a href="{{{ URL::to('admin') }}}">Admin Panel</a>
                @endif
                <a href="{{{ URL::to('user') }}}">Logged in as {{{ Auth::user()->username }}}</a>
                <a href="{{{ URL::to('user/logout') }}}">Logout</a>
                @else
                 <a {{ (Request::is('user/login') ? ' class="active"' : '') }} href="{{{ URL::to('user/login') }}}">Login</a>
                 <a {{ (Request::is('user/register') ? ' class="active"' : '') }} href="{{{ URL::to('user/create') }}}">{{{ Lang::get('site.sign_up') }}}</a>
                @endif

                <a data-toggle="modal" href="#shoppingcart"><i class="icon-shopping-cart"></i> <span class="simpleCart_quantity"></span> items - <span class="simpleCart_grandTotal"></span></a>
              </div>
            </div>
        </div>
     </div>
    </div>
    <!-- Logo & Navigation ends -->
