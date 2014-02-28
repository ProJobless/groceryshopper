
<div class="row">
  <div class="col-xs-12 col-md-8">
      <p> We found the following stores nearby your location </p>
   </div>
  <div class="col-xs-6 col-md-4">
    <button type="submit" id="nearbystores" class="btn btn-sm btn-info">Compare prices</button>
    <button type="submit" class="btn btn-sm btn-info">Add another store</button>
  </div>
</div>
<hr />
<div id="stores" class="list-group">
  @foreach ($stores as $key => $store)
  <div class="searchitem storeitem isotope-item col-xs-6 col-md-3 col-sm-4"
       id="{{$store->id }}itm">
        <div class="store-info store-info-anon">

          <div class="store-name row">
              <h5 class="group inner list-group-searchitem-heading item_name">
                  <a href="">{{ Str::limit($store->title, 25) }}</a>
              </h5>
          </div>
          <div class="row store-address">
                <address>{{ $store->line_1 }} <br />{{ $store->city }} {{ $store->province }} {{ $store->country }}</address>
                <span> <i>{{ round($store->distance, 2) }} KM away</i> </span>
          </div>
          <div class="row">
            <span class="button-checkbox">
                    <button type="button" class="btn btn-sm" data-color="primary">Select to compare</button>
                    <input type="checkbox" class="hidden" />
            </span>
            <div id="filters">
              <input id="storeid_{{ $store->id}}" 
                      name="storeid_{{ $store->id }}" value="{{ $store->id }}" type="checkbox" />
              <label>Select to compare</label>
            </div>
            <!--<a class="btn btn-danger btn-sm item_add" href="javascript:;">Compare this</a>-->
            <a target="" class="linkStoreFlyer" href="{{ $store->url }}">View Weekly Flyer</a>
          </div>
          <span class="icon-chev-right"></span>
      </div>
  </div>
  @endforeach
</div>
