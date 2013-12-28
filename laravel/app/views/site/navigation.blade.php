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
                @if (Auth::check())
                @if (Auth::user()->hasRole('admin'))
                <a href="{{{ URL::to('admin') }}}">Admin Panel</a>
                @endif
                <a href="{{{ URL::to('user') }}}">Logged in as {{{ Auth::user()->username }}}</a>
                <a href="{{{ URL::to('user/logout') }}}">Logout</a>
                @else
                 <a {{ (Request::is('user/login') ? ' class="active"' : '') }} href="{{{ URL::to('user/login') }}}">Login</a>
                 <a {{ (Request::is('user/register') ? ' class="active"' : '') }} href="{{{ URL::to('user/create') }}}">{{{ Lang::get('site.sign_up') }}}</a>
                @endif
              </div>
            </div>
        </div>
     </div>
    </div>
    <!-- Logo & Navigation ends -->
