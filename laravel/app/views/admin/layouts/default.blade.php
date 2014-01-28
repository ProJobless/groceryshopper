</html>
<!DOCTYPE html>
<html lang="en">
	<head id="Grocery Shopper">
		<title>Grocery Shopper Admin</title>

    <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>
        @section('title')
            Administration
        @show
    </title>

    <meta name="keywords" content="@yield('keywords')" />
    <meta name="author" content="@yield('author')" />
    <!-- Google will often use this as its description of your page/site. Make it good. -->
    <meta name="description" content="@yield('description')" />

    <!-- Speaking of Google, don't forget to set your site up: http://google.com/webmasters -->
    <meta name="google-site-verification" content="">

    <!-- Dublin Core Metadata : http://dublincore.org/ -->
    <meta name="DC.title" content="Grocery Shopper">
    <meta name="DC.subject" content="@yield('description')">
    <meta name="DC.creator" content="@yield('groceryshopper.ca')">

    <!--  Mobile Viewport Fix -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <!-- This is the traditional favicon.
     - size: 16x16 or 32x32
     - transparency is OK
     - see wikipedia for info on browser support: http://mky.be/favicon/ -->
    <link rel="shortcut icon" href="{{{ asset('assets/ico/favicon.png') }}}">

    <!-- iOS favicons. -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{{ asset('assets/ico/apple-touch-icon-144-precomposed.png') }}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{{ asset('assets/ico/apple-touch-icon-114-precomposed.png') }}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{{ asset('assets/ico/apple-touch-icon-72-precomposed.png') }}}">
    <link rel="apple-touch-icon-precomposed" href="{{{ asset('assets/ico/apple-touch-icon-57-precomposed.png') }}}">
        <!-- Styles -->
        <!-- Bootstrap CSS -->
        {{ HTML::style('assets/css/bootstrap.min.css'); }}
        {{ HTML::style('assets/css/jquery-ui.css'); }}
        {{ HTML::style('assets/css/bootbox.min.css'); }}
        <!-- Animate css -->
        {{ HTML::style('assets/css/font-awesome.min.css'); }}
        <!-- Dropdown menu -->

        {{ HTML::style('assets/css/fullcalendar.css'); }}
        {{ HTML::style('assets/css/jquery.jscrollpane.css'); }}
        {{ HTML::style('assets/css/select2.css'); }}
        {{ HTML::style('assets/css/icheck/flat/blue.css'); }}

        <!-- Countdown -->
        {{ HTML::style('assets/css/unicorn.css'); }}


		<!--[if lt IE 9]>
		<script type="text/javascript" src="js/respond.min.js"></script>
		<![endif]-->
    <!-- Asynchronous google analytics; this is the official snippet.
     Replace UA-XXXXXX-XX with your site's ID and uncomment to enable.
    <script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-31122385-3']);
        _gaq.push(['_trackPageview']);

        (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();

    </script> -->
			
	</head>	
	<body data-color="grey" class="flat">
		<div id="wrapper">
			<div id="header">
				<h1><a href="{{ URL::to('/admin') }}">Grocery Shopper admin</a></h1>	
				<a id="menu-trigger" href="#"><i class="fa fa-bars"></i></a>	
			</div><!-- header -->
			<div id="user-nav">
			    <ul class="btn-group">
				<li class="btn" ><a title="" href="{{{ URL::to('/') }}}"><i class="fa fa-th"></i> <span class="text">View Homepage</span></a></li>
				<li class="btn" ><a title="" href="{{{ URL::to('/user/settings') }}}"><i class="fa fa-user"></i> <span class="text">{{{ Auth::user()->username }}}</span></a></li>
				<li class="btn dropdown" id="menu-messages">
			            <a href="#" data-toggle="dropdown" data-target="#menu-messages" class="dropdown-toggle"><i class="fa fa-envelope"></i> <span class="text">Messages</span> <span class="label label-danger">0</span> <b class="caret"></b></a>
				    <ul class="dropdown-menu messages-menu">
					<li class="title"><i class="fa fa-envelope-alt"></i>Messages<a class="title-btn" href="#" title="Write new message"><i class="fa fa-share"></i></a></li>
					<li class="message-item">
						<a href="#">
						    <img alt="User Icon" src="img/demo/av1.jpg" />
						    <div class="message-content">
							<span class="message-time">
								3 mins ago
							    </span>
							<span class="message-sender">
							    Nunc Cenenatis
							</span>
							<span class="message">
							    Hi, can you meet me at the office tomorrow morning?
							</span>
						    </div>
						</a>
					</li>
				    </ul>
				</li>
				<!--<li class="btn"><a title="" href="{{ URL::to('/user/settings') }}"><i class="fa fa-cog"></i> <span class="text">Settings</span></a></li> -->
				<li class="btn"><a title="" href="{{ URL::to('/user/logout') }}"><i class="fa fa-share"></i> <span class="text">Logout</span></a></li>
			    </ul>
	        	</div> <!-- end user-nav -->
		       <div id="switcher">
			    <div id="switcher-inner">
				<h3>Theme Options</h3>
				<h4>Colors</h4>
				<p id="color-style">
				    <a data-color="orange" title="Orange" class="button-square orange-switcher" href="#"></a>
				    <a data-color="turquoise" title="Turquoise" class="button-square turquoise-switcher" href="#"></a>
				    <a data-color="blue" title="Blue" class="button-square blue-switcher" href="#"></a>
				    <a data-color="green" title="Green" class="button-square green-switcher" href="#"></a>
				    <a data-color="red" title="Red" class="button-square red-switcher" href="#"></a>
				    <a data-color="purple" title="Purple" class="button-square purple-switcher" href="#"></a>
				    <a href="#" data-color="grey" title="Grey" class="button-square grey-switcher"></a>
				</p>
				<!--<h4>Background Patterns</h4>
				<h5>for boxed version</h5>
				<p id="pattern-switch">
				    <a data-pattern="pattern1" style="background-image:url('assets/img/patterns/pattern1.png');" class="button-square" href="#"></a>
				    <a data-pattern="pattern2" style="background-image:url('assets/img/patterns/pattern2.png');" class="button-square" href="#"></a>
				    <a data-pattern="pattern3" style="background-image:url('assets/img/patterns/pattern3.png');" class="button-square" href="#"></a>
				    <a data-pattern="pattern4" style="background-image:url('assets/img/patterns/pattern4.png');" class="button-square" href="#"></a>
				    <a data-pattern="pattern5" style="background-image:url('assets/img/patterns/pattern5.png');" class="button-square" href="#"></a>
				    <a data-pattern="pattern6" style="background-image:url('assets/img/patterns/pattern6.png');" class="button-square" href="#"></a>
				    <a data-pattern="pattern7" style="background-image:url('assets/img/patterns/pattern7.png');" class="button-square" href="#"></a>
				    <a data-pattern="pattern8" style="background-image:url('assets/img/patterns/pattern8.png');" class="button-square" href="#"></a>
				</p>-->
				<h4 class="visible-lg">Layout Type</h4>
				<p id="layout-type">
					<a data-option="flat" class="button" href="#">Flat</a>
				    <a data-option="old" class="button" href="#">Old</a>                    
				</p>
			    </div>
			    <div id="switcher-button">
				<i class="fa fa-cogs"></i>
			    </div>
			</div><!-- switcher -->
			<div id="sidebar">
				<div id="search">
					<input type="text" placeholder="Search here..."/><button type="submit" class="tip-right" title="Search"><i class="fa fa-search"></i></button>
				</div>	
				<ul>
                        		<li{{ (Request::is('admin') ? ' class="active"' : '') }}>
						<a href="{{{ URL::to('admin') }}}"><i class="fa fa-home"></i> <span>Dashboard</span></a>
					</li>
                        		<li{{ (Request::is('admin/groceryitems') ? ' class="active submenu open"' : ' class="submenu"') }}>
						<a href="{{{ URL::to('admin/groceryitems') }}}"><i class="fa fa-flask"></i> <span>Grocery items</span> <i class="arrow fa fa-chevron-right"></i></a>
						<ul>
							<li><a href="{{{ URL::to('admin/groceryitems') }}}">List </a></li>
							<li><a href="{{{ URL::to('admin/groceryitems/add') }}}">Add </a></li>
							<li><a href="{{{ URL::to('admin/groceryitems/add') }}}">Categories</a></li>
						</ul>
					</li>
                        		<li {{ ( ( Request::is('admin/roles') || Request::is('admin/users') || Request::is('admin/permissions') ) ? ' class="submenu active open"' : ' class="submenu"') }}>
						<a href="#"><i class="glyphicon glyphicon-user"></i> <span>Users</span> <i class="arrow fa fa-chevron-right"></i></a>
						<ul>
                                			<li{{ (Request::is('admin/users*') ? ' class="active"' : '') }}>
							 	<a href="{{{ URL::to('admin/users') }}}">List </a>
							</li>
							<li{{ (Request::is('admin/roles*') ? ' class="active"' : '') }}>
								<a href="{{{ URL::to('admin/roles') }}}"><span class="glyphicon glyphicon-user"></span> Roles</a>
							</li>
							<li{{ (Request::is('admin/permissions*') ? ' class="active"' : '') }}>
								<a href="{{{ URL::to('admin/permissions') }}}"><span class="glyphicon glyphicon-user"></span> Permissions</a>
							</li>
						</ul>
					</li>
                        		<li {{ ( ( Request::is('admin/stores')) ? ' class="submenu active open"' : ' class="submenu"') }}>
						<a href="#"><i class="fa fa-th"></i> <span>Stores</span> <i class="arrow fa fa-chevron-right"></i></a>
						<ul>
                                			<li{{ (Request::is('admin/stores*') ? ' class="active"' : '') }}>
							 	<a href="{{{ URL::to('admin/stores') }}}">List </a>
							</li>
							<li{{ (Request::is('admin/stores/add') ? ' class="active"' : '') }}>
								<a href="{{{ URL::to('admin/stores/add') }}}"><span class="glyphicon glyphicon-user"></span>Add </a>
							</li>
						</ul>
					</li>
				</ul>
			
			</div><!-- end sidebar -->

			<!-- Content -->
			<div id="content">
				<div id="content-header">
					<h1>
						@section('pagetitle')
						@show
					</h1>
					<div class="btn-group">
						<a class="btn" title="Manage Grocery items"><i class="fa fa-file"></i></a>
						<a class="btn" title="Manage Users" href="{{{ URL::to('admin/users') }}}"><i class="fa fa-user"></i></a>
						<a class="btn" title="Manage Comments"><i class="fa fa-comment"></i><span class="label label-danger">5</span></a>
						<a class="btn" title="Manage Orders"><i class="fa fa-shopping-cart"></i></a>
					</div>
				</div>
				<div id="breadcrumb">
					@section('breadcrumb')
					<a href="{{{ URL::to('admin/') }}}" title="Go to Home" class="tip-bottom">
						<i class="fa fa-home"></i> Home
					</a>
					@show
				</div>
				<div class="container-fluid">
					<div class="row">
						<div class="col-xs-12 center" style="text-align: center;">					
							<ul class="quick-actions">
								<li>
									<a href="{{{ URL::to('admin/groceryitems') }}}">
										<i class="icon-shopping-bag"></i>
										Manage Grocery Items
									</a>
								</li>
								<li>
									<a href="{{{ URL::to('admin/stores') }}}">
										<i class="icon-database"></i>
										Manage Stores
									</a>
								</li>
								<li>
									<a href="{{{ URL::to('admin/users') }}}">
										<i class="icon-people"></i>
										Manage Users
									</a>
								</li>
							</ul>
						</div>	
					</div>
					<br />
					@yield('content')
				</div>
			<!-- ./ Footer -->
			 </div>
			<!-- ./ content -->
				<div class="row">
			<div id="footer" class="col-xs-12">
			    	@yield('footer')
				2013 - 2014 © groceryshopper.ca.
			</div>
			</div>
		</div><!-- wrapper -->
		
        <!-- Javascripts
        ================================================== -->
        <!-- jQuery -->
        {{ HTML::script('assets/js/excanvas.js'); }}
        {{ HTML::script('assets/js/jquery.min.js'); }}
        {{ HTML::script('assets/js/jquery-ui.custom.js'); }}
        <!-- Bootstrap JS -->
        {{ HTML::script('assets/js/bootstrap.min.js'); }}
        {{ HTML::script('assets/js/jquery.flot.min.js'); }}
        {{ HTML::script('assets/js/jquery.flot.resize.min.js'); }}
        {{ HTML::script('assets/js/jquery.sparkline.min.js'); }}
        {{ HTML::script("assets/js/jquery.nicescroll.min.js"); }}
        {{ HTML::script("assets/js/jquery.dataTables.min.js"); }}
        <!-- Countdown -->
        {{ HTML::script("assets/js/fullcalendar.min.js"); }}
        {{ HTML::script("assets/js/bootbox.min.js"); }}

        <!-- Validation -->
       {{ HTML::script("assets/js/select2.min.js"); }}
       {{ HTML::script("assets/js/jquery.icheck.min.js"); }}
       {{ HTML::script("assets/js/jquery.validate.js"); }}
       
       {{ HTML::script("assets/js/unicorn.js"); }}
       {{ HTML::script("assets/js/unicorn.dashboard.js"); }}

        
	<!-- local scripts -->
	@yield('scripts');

	</body>
</html>
