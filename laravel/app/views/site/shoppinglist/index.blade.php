@extends('site.layouts.default')
@section('content')
      <!-- Hero starts -->
      <div class="hero">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <!-- Catchy title -->
                  <h3>Your Shopping list<span class="color"></span></h3>
               </div>
            </div>
         </div>
      </div>
    <!-- Hero ends -->
    <div class="blocky">
     <div class="container center-block">
      <div class="row">
         <div class="col-md-10 col-md-offset-1">
              <div class="simpleCart_items"></div>
              <!-- grand total, including tax and shipping (ex. $28.49) -->
              <div class="simpleCart_grandTotal"></div>
              <div id="nearbystores_container" class="nearbystores">
              </div>
       </div>
    </div>
   </div>
  </div>

@stop
@section('scripts')
{{ HTML::script('assets/js/jquery.geolocation.js'); }}
{{ HTML::script('assets/js/isotope/jquery.isotope.min.js'); }}
{{ HTML::script('assets/js/jquery.compare/jquery.compare.min.js'); }}

<script type="text/javascript">
$(document).ready(function(){

  function saveMyLocation(position) {
    // Write to hidden inputs.
    $('#mylatitude').val(position.coords.latitude);
    $('#mylongitude').val(position.coords.longitude);
    fetchNearbyStores(position.coords.latitude, position.coords.longitude);
  }

  function fetchNearbyStores(lat, long) {
    // fetch the current closest stores
    var request = $.ajax({
       url: "/shoppinglist/nearbystores",
       type: "GET",
       data: { 
         "mylatitude" : lat,
         "mylongitude" : long, 
         "_token" : "{{ Session::token() }}"

       },
       dataType: "html"
    });

    // Load results
    request.done(function( msg ) {
      $( "#nearbystores_container" ).html( msg );
      // Load the compare plugin.
      $('#stores').compare({myclass: '.storeitem', myid: '#itm', checkboxes: 'input',  active: '.selected', scrolltoTop: true});
          
    });

    // silently fail.
    request.fail(function( jqXHR, textStatus ) {
      $( "#nearbystores_container" ).html( "No location provided");
    });
 
   }

  function noLocation(error) {
    // No location found. so request for address via server.
    fetchNearbyStores(NULL, NULL);

  }
  function alertMyPosition(position) {
      alert("Your position is " + position.coords.latitude + ", " + position.coords.longitude);
        $('#geo').html(position.timestamp + ": " + position.coords.latitude + ", " + position.coords.longitude + "<br />" + $('#geo').html());
  }
  $('#getPositionButton').bind('click', function() {
      $.geolocation.get({win: alertMyPosition, fail: noLocation});
    });
       
$('#watchPositionButton').bind('click', function() {
    // alertMyPosition is called each time the user's position changes
    myPosition = $.geolocation.watch({win: alertMyPosition}); 
});

  $('#stopButton').bind('click', function() {
        $.geolocation.stop(myPosition);
  });

  function showError(error) {
          switch(error.code) 
          {
            case error.PERMISSION_DENIED:
              console.log("User denied the request for Geolocation.");
              fetchNearbyStores(0, 0);
              break;
            case error.POSITION_UNAVAILABLE:
              console.log("Location information is unavailable.");
              break;
            case error.TIMEOUT:
              console.log("The request to get user location timed out.");
              break;
            case error.UNKNOWN_ERROR:
              console.log("An unknown error occurred.");
              break;
        }
  }


  $.geolocation.get({win: saveMyLocation, fail: noLocation});
  if(navigator.geolocation) {
    console.log("Location");
    navigator.geolocation.getCurrentPosition(saveMyLocation,showError);
    $.geolocation.get({win: saveMyLocation, fail: noLocation});
  }else {
    console.log("No location");
  }

});
</script>
@stop
