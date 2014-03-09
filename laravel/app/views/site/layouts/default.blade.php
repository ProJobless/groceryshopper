<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Basic Page Needs
        ================================================== -->
        <meta charset="utf-8" />
        <title>
            @section('title')
            Groceryshopper.ca: Find you groceries fast!!
            @show
        </title>
        <meta name="viewport" content="width=1024">
        <meta http-equiv="cleartype" content="on">
        <meta name="mobileoptimized" content="1024">
        <meta name="format-detection" content="telephone=yes">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta http-equiv="description" content="Grocery Supermarkets is home to Great Food. Use our store locator to locate a Grocery store near you, view the weekly local store flyer.">

        <meta property="og:title" content="Grocery shopper - Find grocery deals fast!!">
        <meta property="og:description" content="Use our store locator to locate a Grocery store near you, view the weekly local store flyer.">
        <meta property="og:url" content="http://www.groceryshopper.ca/en_CA.html">

        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta http-equiv="keywords" content="">

        <!-- Mobile Specific Metas
        ================================================== -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- CSS
        ================================================== -->

        <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,600italic,600' rel='stylesheet' type='text/css'>

        <!-- jQuery -->
        {{ HTML::script('assets/js/jquery.js'); }}
        <!-- Bootstrap JS -->
        {{ HTML::script('assets/js/bootstrap.min.js'); }}
        <!-- Bootstrap Paginator -->
        {{ HTML::script("assets/js/bootstrap-paginator.min.js"); }}

       <!-- Styles -->
        <!-- Bootstrap CSS -->
        {{ HTML::style('assets/css/bootstrap.min.css'); }}
        <!-- Animate css -->
        {{ HTML::style('assets/css/animate.min.css'); }}
        <!-- Dropdown menu -->

        {{ HTML::style('assets/css/ddlevelsmenu-base.css'); }}
        {{ HTML::style('assets/css/ddlevelsmenu-topbar.css'); }}

        <!-- Countdown -->
        {{ HTML::style('assets/css/jquery.countdown.css'); }}

        <!-- Font awesome CSS -->
        {{ HTML::style('assets/css/font-awesome.min.css'); }}

        <!-- Custom CSS -->
        {{ HTML::style('assets/css/style.css'); }}

        <!-- shopping list -->
        {{ HTML::style('assets/css/shoppinglist.css'); }}

        <!-- local css  -->
        <!-- Favicons
        ================================================== -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{{ asset('assets/ico/apple-touch-icon-144-precomposed.png') }}}">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{{ asset('assets/ico/apple-touch-icon-114-precomposed.png') }}}">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{{ asset('assets/ico/apple-touch-icon-72-precomposed.png') }}}">
        <link rel="apple-touch-icon-precomposed" href="{{{ asset('assets/ico/apple-touch-icon-57-precomposed.png') }}}">
        <link rel="shortcut icon" href="{{{ asset('assets/ico/favicon.png') }}}">
    </head>
    <body>
        <!-- Navigation -->
          @include('site.layouts.modal-checkout')
        <!-- ./ navigation -->

        <!-- Navigation -->
          @include('site.layouts.navigation')
        <!-- ./ navigation -->
        <div class="clearfix"></div>

        <!-- Notifications -->
        @include('notifications')
        <!-- ./ notifications -->


        <!-- Content -->
        @yield('content')
        <!-- ./ content -->

        @include('site.layouts.footer')
        <!-- Javascripts
        ================================================== -->
        <!-- Dropdown menu -->
        {{ HTML::script('assets/js/ddlevelsmenu.js'); }}
        <!-- CaroFredSel -->
        {{ HTML::script("assets/js/jquery.carouFredSel-6.2.1-packed.js"); }}
        <!-- Countdown -->
        {{ HTML::script("assets/js/jquery.countdown.min.js"); }}
        <!-- jQuery Navco -->
        {{ HTML::script("assets/js/jquery.navgoco.min.js"); }}
        <!-- Filter for support page -->
        {{ HTML::script("assets/js/filter.js"); }}
        <!-- Respond JS for IE8 -->
        {{ HTML::script("assets/js/respond.min.js"); }}
        <!-- HTML5 Support for IE -->
        {{ HTML::script("assets/js/html5shiv.js"); }}
        {{ HTML::script("assets/js/custom.js"); }}a
        {{ HTML::script("assets/js/simplecart-js/simpleCart.min.js"); }}
    <script type="text/javascript">
       function getStartedInitialization(){
        var options = {
            currentPage: 3,
            totalPages: 10
        }

        $('#toppager').bootstrapPaginator(options);
          }
    </script>

  <script type="text/javascript">
    simpleCart({
        cartColumns: [
                { view:'image' , attr:'thumb', label: false},
                { attr: "name" , label: "Name" } ,
                { view: "decrement" , label: false , text: "-" } ,
                { view:'input', attr:'quantity', label: "Quantity" },
                { view: "increment" , label: false , text: "+" } ,
                { view: "remove" , text: "Remove" , label: "Action" }
       ],
       cartStyle: "table",
       // set the currency, see the currency 
       // reference for more info
       currency: "CAD",

       // collection of arbitrary data you may want to store 
       // with the cart, such as customer info
       data: {},

       // set the cart langauge 
       // (may be used for checkout)
       language: "english-us",

       // array of item fields that will not be 
       // sent to checkout
       excludeFromCheckout: [],

       // custom function to add shipping cost
       shippingCustom: null,

       // flat rate shipping option
       shippingFlatRate: 0,

       // added shippingCustompping based on this value 
       // multiplied by the cart quantity
       shippingFlatRategQuantityRate: 0,

       // added shipping based on this value 
       // multiplied by the cart subtotal
       shippingTotalRate: 0,

       // tax rate applied total cart subtotal
       taxRate: 0,

       // true if tax should be applied to shippinging
       taxShipping: false,

       checkout: {
              type: "SendForm" , 
              url: "http://dev.groceryshopper.ca/shoppinglist/view/{{ Session::getToken() }}",
              // http method for form, "POST" or "GET", default is "POST"
              method: "POST" , 

              // url to return to on successful checkout, default is null
              success: "success.html" ,
              // url to return to on cancelled checkout, 
              // default is null
              cancel: "cancel.html" ,

              // an option list of extra 
              //name/value pairs that can
            // be sent along 
            // with the checkout 
            // data
            extra_data: 
            {
                 storename:"test-store",
                _token: "{{ Session::getToken(); }}",
            }

       },
       beforeAdd               : null,
       afterAdd                : null,
       load                    : null,
       beforeSave              : null,
       afterSave               : null,
       update                  : null,
       ready                   : null,
       checkoutSuccess         : null,
       checkoutFail            : null,
       beforeCheckout          : null
    });
    // basic callback example
    simpleCart.bind( "afterAdd" , function( item ){
       console.log( item.get("name") + " was added to the cart!" );
    });
    // simple callback example
    simpleCart.bind( 'beforeRemove' , function( item ){
       console.log( item.get('name') + " was removed from the cart" ); 
    });
    simpleCart.bind( 'afterSave' , function(){
      
      $('.prod_item_system_id').remove();
      $('.prod_item_quantity').remove();

      simpleCart.each(function( item , x ){
        console.log(item.get('systemid'));
        $('<input>').attr({
          type: 'hidden',
          class: 'prod_item_system_id',
              id: 'item_id_' + x,
              name: 'item_id_' + x,
              value: item.get('systemid')
        }).appendTo('#comparestores');
        $('<input>').attr({
          type: 'hidden',
          class: 'prod_item_quantity',
          id: 'item_quantity_' + x,
          name: 'item_quantity_' + x,
          value: item.get('quantity')
        }).appendTo('#comparestores');
      });

    });

    simpleCart.bind( 'update' , function(){
        console.log( "Whoa, the cart total is now at " + simpleCart.toCurrency( simpleCart.grandTotal() ) + "! Nice!" ); 
    });
    simpleCart.bind( 'load' , function(){
      $('.prod_item_system_id').remove();
      $('.prod_item_quantity').remove();

      simpleCart.each(function( item , x ){
        console.log(item.get('systemid'));


        $('<input>').attr({
          type: 'hidden',
          class: 'prod_item_system_id',
              id: 'item_id_' + x,
              name: 'item_id_' + x,
              value: item.get('systemid')
        }).appendTo('#comparestores');
        $('<input>').attr({
          type: 'hidden',
          class: 'prod_item_quantity',
          id: 'item_quantity_' + x,
          name: 'item_quantity_' + x,
          value: item.get('quantity')
        }).appendTo('#comparestores');

      });
        console.log( "simpleCart has loaded " + simpleCart.quantity() + " items from from localStorage" ); 
    });
    console.log(simpleCart.quantity());
  </script>
    <!-- local scripts -->
    @yield('scripts');
    </body>
</html>
