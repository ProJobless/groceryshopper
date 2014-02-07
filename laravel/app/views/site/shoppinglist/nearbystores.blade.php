<div class="overlay-wrap overlay-find-store" style="top: 0px;">
 <div class="inner">
   <div class="overlay">
       <h4 class="title">To find another store:</h4>
           <form action="/en_CA/storeresults.html" method="get" class="uniform overlay-find-store-form">
               <input type="text" name="location" class="input-search" placeholder="Enter your address, postal code or city">
                 <button type="button" data-toggle="modal" id="" data-target="#storefinder" class="btn btn-info">Find the closest store</button>
               <div class="err-msg">Sorry, no results found for your search</div>
           </form>
           <a href="#" class="close">close</a>
    </div>
  </div>
 </div>
  <h4> We found the following stores nearby your location </h4>
<div id="stores" class="row list-group">
  @foreach ($stores as $key => $store)
  <div id="store-info-holder" class="store-info-holder storeitem isotope-item col-xs-6 col-md-3 col-sm-4" id="{{$key}}itm">
        <div class="store-info store-info-anon">
          <div class="store-name row">
                <a href="/en_CA/storedetail.2019.html" class="linkStoreDetails">
                  <span class="textStoreName">{{ $store->title }} </span></a>
                &nbsp;(<a class="find-store-overlay-trigger" href="#" data-overlay-find-store="To find another store:" data-overlay-find-store-url="/en_CA/storeresults.html">Remove</a>)
          </div>
          <div class="row store-address">
                <address>{{ $store->line_1 }} <br />{{ $store->city }} {{ $store->province }} {{ $store->country }}</address>
                <span> {{ round($store->distance, 2) }} KM away </span>
          </div>
          <div class="row">
                  <a target="" class="linkStoreFlyer" href="{{ $store->url }}">View Weekly Flyer</a>
                  <span class="icon-chev-right"></span>
                  <div id="filters">    
                                <input type="checkbox"><label>Select to compare</label>
                  </div>
                  <a class="btn btn-danger btn-sm item_add" href="javascript:;">Compare this</a>
                  <form action="/en_CA/storeresults.html" method="get" class="uniform overlay-find-store-form">
                      <input type="hidden" name="id" value="{{ $store->id }}" />
                  </form>
          </div>
          <span class="icon-chev-right"></span>
      </div>
  </div>
  @endforeach
</div>
<div class="modal-footer">
  <form action="/shoppinglist/compare" method="post">
    {{ Form::token() }}
    <button type="submit" id="nearbystores" class="btn btn-info">Compare prices at selected stores</button>
  </form>
</div>
