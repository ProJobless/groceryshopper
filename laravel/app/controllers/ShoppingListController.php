<?php
/**
 * Search controller
 *
 * Allows you to search tags, users, and by keywords
 *
 * @license     http://www.opensource.org/licenses/mit MIT License
 * @link       http://bundles.laravel.com
 * @package     Laravel-Bundles
 * @subpackage  Controllers
 * @filesource
 */

class ShoppingListController extends BaseController {

    /**
    * Tell Laravel we want this class restful. See:
    * http://laravel.com/docs/start/controllers#restful
    *
    * @param bool
    */
    public $restful = true;

    
    public function __construct()
    {
      parent::__construct();
      // Exit if not ajax.
      $this->beforeFilter('ajax', array('only' => 'shoppinglist'));

      // Exit if not a valid _token.
      $this->beforeFilter('csrf', array('only' => 'shoppinglist'));
    }
    
    /**
    * Search index
    *
    * Used by keyword searching.
    */
    public function getIndex()
    {
      return View::make('site/index');
    }

    

    /**
    * Search index
    *
    * Used by keyword searching.
    */
    public function getCompare() {


    }

    /**
    * Search index
    *
    * Used by keyword searching.
    */
    public function postCompare() {

      // Validate that there are stores selected
      // Get the passed values
      $input = $this->_getCompareValues(Input::all());

      $rules = array(
            'mylatitude'   => 'required',
            'mylongitude' => 'required',
      );

      // Validate the inputs
      $validator = Validator::make(Input::all(), $rules);

      $token = Input::get('_token');
      // Check if latitud and longitude validates with success
      if ($validator->passes())
      {

        $lat = Input::get('mylatitude');
        $long = Input::get('mylongitude');
        $lat = 45.507843;
        $long = -73.801814;

        //Check that there are stores to compare
        if( count($input['stores']) >= 2) {

          //Now we begin the processing
          // forach store, find the total cost of
          // all items + compute the cost of gas for
          // and average consumption of 9.0L/100KM.
          $stores = array();
          foreach($input['stores'] as $store) {

            $pricefinder = new \Groceryshopper\PriceFinder\PriceFinder;

            // compute total cost of shopping basket
            $item_costs = $pricefinder->getTotalCost($input['products'], $store);
            $store->total_cost = $item_costs['total'];
            $store->item_prices = $item_costs['itemcosts'];
            // compute the gas cost.
            $store->total_gas_cost = $pricefinder->getGasConsumption($store,
              $lat, $long);

            $stores[] = $store;
          }
          return View::make('site/shoppinglist/compare-results', compact('stores', 'lat','long'));
        }

        // Return due to lack of enough stores to compare.
        return Redirect::to('shoppinglist/view/'.$token)
              ->with('error',
                   Lang::get('site/shoppinglist/messages.compare.no_selected_stores')
        );

      }

      // Return results in new screen
      return Redirect::to('shoppinglist/view/'.$token)
             ->with('error',
                    Lang::get('site/shoppinglist/messages.compare.missinglocation')
      );

    }

    /**
    * Search index
    *
    * Used by keyword searching.
    */
    public function getShow()
    {
      // Show the page.
      // Get the current token.
      return View::make('site/shoppinglist/index', compact('cart_id'));
    }
    public function getDistance() {
    
    }

   /**
    * Search index
    *
    * Used by keyword searching.
    */
    public function postShow()
    {

      // We need to do a location detection,
      // so we can find out where the user is
      // from.
      $geocoder = new \Geocoder\Geocoder();
      $adapter = new \Geocoder\HttpAdapter\CurlHttpAdapter;
      $chain    = new \Geocoder\Provider\ChainProvider(array(
      new \Geocoder\Provider\FreeGeoIpProvider($adapter),
      new \Geocoder\Provider\HostIpProvider($adapter),
      new \Geocoder\Provider\GoogleMapsProvider($adapter, 'en_CA', 'Canada', true),
      ));
      $geocoder->registerProvider($chain);
      try {
          $geocode = $geocoder->geocode('');
          
        // $result is an instance of ResultInterface
        $formatter = new \Geocoder\Formatter\Formatter($geocode);
      } catch (Exception $e) {
          echo $e->getMessage();
      }

      $cart_id = Input::get('cart_id');
      $token  = 'cart-'. bin2hex(openssl_random_pseudo_bytes(16));
      return View::make('site/shoppinglist/index', compact('cart_id'));
     }
   /**
     * Show a list of closest stores based on user provided lat and
     * longitude formatted in html.
     *
     * @return List of stores JSON
     */
   public function getNearbystores($token = NULL) {

     if (is_null($token)) { $token = Input::get('_token'); }

     if ( Session::token() !== $token) {
         return $this->_make_response( json_encode( array(
             'msg' => 'Unauthorized attempt to fetch data for stores' ) ) );
     }
     // Fetch all the stores within 5KM of the users coords.
     $latitude = 45.507843;
     $longitude = -73.801814;
     //$latitude = Input::get('mylatitude');
     //$longitude = Input::get('mylongitude');

     // If no latitide or long supplied, use the user's ip address
     // to get the latitude and longitude
     if(!isset($latitude) || !isset($longitude)) {
      // Use the ip address to determine the location
       $ip = Request::ip();
     }

     // Using the latitude/long
     $stores = $this->fetchStoresNearby($latitude, $longitude, 5);

     return View::make('site/shoppinglist/nearbystores', compact('stores'));
    }


    /**
     * Show a list of all the search results formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function fetchStoresNearby($latitude, $longitude, $noofstores, $within = 5)
    {
      //Fetch all stores in chucks of 200.
      $closest_stores = array();
      Store::chunk(200, function($stores) use( &$latitude, &$longitude, &$closest_stores, &$within)
      {
        foreach ($stores as $store)
        {
          //find distance between user and store
          $distance = $this->distance($latitude, $longitude, $store->latitude, $store->longitude, 'K');
          if($distance <= $within) {
            $store->distance = $distance;
            $closest_stores[$store->id] = $store;
          }

        }
        usort($closest_stores, array('ShoppingListController', '_sort_by_distance'));
      });
      return array_slice($closest_stores, 0 , $noofstores, TRUE);
    }


   /**
     * Show a list of all the search results formatted for Datatables.
     *
     * @return Datatables JSON
     */
    private static function _sort_by_distance($a, $b) {
        return strcmp($a->distance, $b->distance);
    }


    protected function _getCompareValues($input) {
      // We find all the listed stores for comparing
      // prices
      $stores = array();
      $products = array();
      foreach($input as $key => $value) {
        // storeid pattern
        $storeid_pattern = '/storeid_/i';

        if(preg_match($storeid_pattern, $key)) {
          $stores[] = Store::find((int) $value);
        }
        // product_id pattern
        $product_pattern = '/item_(id|quantity)_(\d{1,5})/';
        preg_match_all($product_pattern, $key, $matches, PREG_SET_ORDER);
        foreach ($matches as $val) {
          if ($val[1] === 'id' ) {
            $products[$val[2]]['id'] = $value;
          }else {
            $products[$val[2]]['quantity'] = $value;
          }
        }
      }
      return array("stores" => $stores, "products" => $products);
    }
    /**
     * Show a list of all the search results formatted for Datatables.
     *
     * @return Datatables JSON
     */
    protected function _make_response( $response_str, $type = 'application/json' ) {
        $response = Response::make( $response_str );
        $response->header( 'Content-Type', $type );
        return $response;
    }

   /*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
    /*::                                                                         :*/
    /*::  This routine calculates the distance between two points (given the     :*/
    /*::  latitude/longitude of those points). It is being used to calculate     :*/
    /*::  the distance between two locations using GeoDataSource(TM) Products    :*/
    /*::                                               :*/
    /*::  Definitions:                                                           :*/
    /*::    South latitudes are negative, east longitudes are positive           :*/
    /*::                                                                         :*/
    /*::  Passed to function:                                                    :*/
    /*::    lat1, lon1 = Latitude and Longitude of point 1 (in decimal degrees)  :*/
    /*::    lat2, lon2 = Latitude and Longitude of point 2 (in decimal degrees)  :*/
    /*::    unit = the unit you desire for results                               :*/
    /*::           where: 'M' is statute miles                                   :*/
    /*::                  'K' is kilometers (default)                            :*/
    /*::                  'N' is nautical miles                                  :*/
    /*::  Worldwide cities and other features databases with latitude longitude  :*/
    /*::  are available at http://www.geodatasource.com                          :*/
    /*::                                                                         :*/
    /*::  For enquiries, please contact sales@geodatasource.com                  :*/
    /*::                                                                         :*/
    /*::  Official Web site: http://www.geodatasource.com                        :*/
    /*::                                                                         :*/
    /*::         GeoDataSource.com (C) All Rights Reserved 2014              :*/
    /*::                                                                         :*/
    /*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
    private function distance($lat1, $lon1, $lat2, $lon2, $unit = 'K') {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);
        if ($unit == "K") {
           return ($miles * 1.609344);
        } else if ($unit == "N") {
           return ($miles * 0.8684);
        } else {
           return $miles;
        }
    }
    
}
