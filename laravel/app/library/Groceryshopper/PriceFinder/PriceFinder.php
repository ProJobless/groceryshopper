<?php namespace Groceryshopper\PriceFinder;

use Store;
use DB;
use Groceryitem;
use Carbon\Carbon;
use tidy;


class PriceFinder {

  public function getTotalCost(array $products, Store $store) {

    if (!is_array($products)) { return NULL; }//$products = array($products); }

    $totalcost = array();
    $totalcost['total'] = 0;
    foreach($products as $item) {
      // Get the item cost at store
      $groceryitem = Groceryitem::where('factual_id', '=', $item['id'])->firstOrFail();
      if (!is_null($groceryitem->id))  {
        $itemprice = $this->getItemPriceAtStore($groceryitem, $store);
        if (!is_null($itemprice)) {
            // compute total cost
            $itemcost = $this->getItemCost($itemprice, $item['quantity']);
        }
      }
      $totalcost['itemcosts'][$groceryitem->id] = $itemcost;
      // Add up the totals
      $totalcost['total'] = $totalcost['total'] + $itemcost;
    }

    return $totalcost;

  }

  public function getItemPriceAtStore(Groceryitem $item, Store $store) {
      $itemprice = DB::table('groceryitem_store')
                    ->where('groceryitem_id', $item->id)
                    ->where('store_id', $store->id)
                    ->first();
      return (is_null($itemprice)) ? NULL : $itemprice;
  }

  public function getItemCost($itemprice, $quantity) {

    // Find unit cost of the item
    $unitcost = ($itemprice->price / 2);
    // use the quantity given by the consumer 
    // to compute the total cost
    $itemcost = $unitcost * $quantity;

    return $itemcost;
  
  
  }

  public function getGasConsumption(Store $store, $lat, $long) {
  
    // Get the distance
    $distance = $this->getDistance($store->latitude, $store->longitude, $lat, $long, 'K');

    var_dump($distance);
    // Fuel used 
    $fuel_used = ($distance / 100) * 7.9;

    var_dump ($fuel_used);

    $price_at_the_pump = 1.394;
    // Cost of gas (return trip)
    $total_cost = ($fuel_used * $price_at_the_pump) * 2;
    return $total_cost;


  }

  public function getGasCost($distance, $priceperliter) {
  
  }

  protected function getDistance($lat1, $lon1, $lat2, $lon2, $unit = 'K') { 
    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
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

