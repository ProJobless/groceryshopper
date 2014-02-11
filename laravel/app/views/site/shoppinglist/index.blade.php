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
              <form action="/shoppinglist/compare" method="post" class="form-horizontal-well" id="comparestores">
                <input id="mylongitude" name="mylongitude" value="" type="hidden" />
                <input id="mylatitude" name="mylatitude" value="" type="hidden" />
                
                {{ Form::token() }}
              <div class="simpleCart_items"></div>
              <!-- grand total, including tax and shipping (ex. $28.49) -->
              <h4> Compare prices at severel stores</h4>
              <div id="nearbystores_container" class="nearbystores">
                  <p> Loading the closest stores nearby your location 
                    <i class="fa fa-cog fa-spin fa-2x"></i>
                  </p>
                  <div class="modal hide" id="pleaseWaitDialog" data-backdrop="static" data-keyboard="false">
                          <div class="modal-header">
                              <h1>Processing...</h1>
                          </div>
                          <div class="modal-body">
                              <div class="progress progress-striped active">
                                  <div class="bar" style="width: 100%;"></div>
                              </div>
                          </div>
                  </div>
              </div>
</form>
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
      //$('#stores').compare({myclass: '.storeitem', myid: '#itm', checkboxes: 'input',  active: '.selected', scrolltoTop: true});
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


  if(navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(saveMyLocation,showError);
    $.geolocation.get({win: saveMyLocation, fail: noLocation});
  }else {
    console.log("No location");
  }
  $('.button-checkbox').each(function () {
      // Settings
      var $widget = $(this),
          $button = $widget.find('button'),
          $checkbox = $widget.find('input:checkbox'),
          color = $button.data('color'),
          settings = {
              on: {
                  icon: 'glyphicon glyphicon-check'
              },
              off: {
                  icon: 'glyphicon glyphicon-unchecked'
              }
          };

      // Event Handlers
      $button.on('click', function () {
          $checkbox.prop('checked', !$checkbox.is(':checked'));
          $checkbox.triggerHandler('change');
          updateDisplay();
      });
      $checkbox.on('change', function () {
          updateDisplay();
      });

      // Actions
      function updateDisplay() {
          var isChecked = $checkbox.is(':checked');

          // Set the button's state
          $button.data('state', (isChecked) ? "on" : "off");

          // Set the button's icon
          $button.find('.state-icon')
              .removeClass()
              .addClass('state-icon ' + settings[$button.data('state')].icon);

          // Update the button's color
          if (isChecked) {
              $button
                  .removeClass('btn-default')
                  .addClass('btn-' + color + ' active');
          }
          else {
              $button
                  .removeClass('btn-' + color + ' active')
                  .addClass('btn-default');
          }
      }

      // Initialization
      function init() {

          updateDisplay();

          // Inject the icon if applicable
          if ($button.find('.state-icon').length == 0) {
              $button.prepend('<i class="state-icon ' + settings[$button.data('state')].icon + '"></i> ');
          }
      }
      init();
      });
});
</script>
@stop
