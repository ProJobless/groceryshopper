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
					{{ Form::open(array( 'action' => array('SearchController@processSearch'), 'role' => 'search', 'class' => 'form-inline widget-search')) }}
							<div class="form-group">
								 <div class="input-group custom-search-form">
									  {{ Former::text('')->class('form-control')->placeholder('Search')->require()->name('keyword') }}
									  <span class="input-group-btn">
									  <button class="btn btn-info" type="submit">
									  <span class="glyphicon glyphicon-search"></span>  Search

									 </button>
									 </span>
									 </div><!-- /input-group -->
								</div>
					{{ Former::close() }}
					</form>
			   </div>
			</div>
		 </div>
     </div> <!-- end of blocky form -->
      <!-- Items List starts -->

  <div class="cartInfo">
    <span class="simpleCart_quantity"></span> items - <span class="simpleCart_total"></span>
    <a href="javascript:;" class="simpleCart_checkout">Checkout</a>
  </div>





      <div class="shop-items blocky">
		<div class="container">
		     <!-- Pagination -->
		     <div class="row">
			<div id="toppagerx" class="col-md-12">

				<ul id="toppager" class="pagination"></ul>
			</div>
			    <script type='text/javascript'>
				var options = {
				    currentPage: {{ $page }},
				    bootstrapMajorVersion: 3,
				    totalPages: {{ $total_pages }},
				    useBootstrapTooltip:true,
				    tooltipTitles: function (type, page, current) {
					switch (type) {
					case "first":
					    return "Go To First Page <i class='icon-fast-backward icon-white'></i>";
					case "prev":
					    return "Go To Previous Page <i class='icon-backward icon-white'></i>";
					case "next":
					    return "Go To Next Page <i class='icon-forward icon-white'></i>";
					case "last":
					    return "Go To Last Page <i class='icon-fast-forward icon-white'></i>";
					case "page":
					    return "Go to page " + page + " <i class='icon-file icon-white'></i>";
					}
				    },
				    bootstrapTooltipOptions: {
					html: true,
					placement: 'bottom'
				    },
				    pageUrl: function(type, page, current){
						return "{{ URL::to('products/search') }}"+keyword+"/results/page"+"/"+page;
				    }
				}

				$('#toppager').bootstrapPaginator(options);
          </script>


		     </div>
	     <!-- End Pagination -->
		  <div id="products" class="row list-group">
		   @foreach ($results as $result)
          <div class="searchitem  col-xs-6 col-md-3 col-sm-4 simpleCart_shelfItem">
              <div class="thumbnail">
            <img class="group list-group-image img-responsive item_thumb" src="{{ $result['image_urls'][0] or 'http://ct.mywebgrocer.com/legacy/productimagesroot/DJ/0/864170.jpg' }}" alt="" />
            <div class="caption">
            <h4 class="group inner list-group-searchitem-heading item_name">
              {{{ ($result['product_name'])  ? Str::words($result['product_name'], 4) :  "" }}}</h4>
                <p class="group inner list-group-searchitem-text">
                  {{ $result['brand'] or ""}} <br />
                   {{ $result['category'] or  "uncategorized"}} <br />
                   {{ $result['size'][0]  or "1 each"}}<br />
                </p>
                <input type="text" value="1" class="item_Quantity">
                <hr />
                <div class="row">
              <div class="col-xs-12 col-md-6">
                  <div class="item-price lead item_price">
                        ${{ $result['avg_price'] or "N/A"}}</div>
              </div>
              <div class="col-xs-12 col-md-6">
                  <a class="btn btn-danger btn-sm item_add" href="javascript:;">Add to list</a>
              </div>
                </div>
            </div>
              </div>
          </div>
		@endforeach
             </div>
	     <!-- Pagination -->
	     <div class="row">
		<div class="col-md-12">
			    <ul class="pagination">
			      <li><a href="#">&laquo;</a></li>
			      <li><a href="#">1</a></li>
			      <li><a href="#">2</a></li>
			      <li><a href="#">3</a></li>
			      <li><a href="#">4</a></li>
			      <li><a href="#">5</a></li>
			      <li><a href="#">&raquo;</a></li>
			    </ul>
		</div>
	     </div>
	     <!-- End Pagination -->
      	  </div>
	</div>
        <!-- Items List ends -->

@stop

@section('scripts')
  {{ HTML::script("assets/js/simplecart-js/simpleCart.min.js"); }}
  <script type="text/javascript">
    simpleCart({
        cartColumns: [
                { view:'image' , attr:'thumb', label: false},
                { attr: "name" , label: "Name" } ,
                { attr: "price" , label: "Price", view: 'currency' } ,
                { view: "decrement" , label: false , text: "-" } ,
                { view:'input', attr:'quantity', label: "Quantity" },
                { view: "increment" , label: false , text: "+" } ,
                { attr: "total" , label: "SubTotal", view: 'currency' } ,
                { view: "remove" , text: "Remove" , label: false }
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
              url: "http://dev.groceryshopper.ca/shoppinglist/",
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
               cartid: "{{ str_random(40); }}",
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
  </script>
@stop
