<?php namespace Groceryshopper\PriceFinder;

use Store;
use Groceryitem;
use Carbon\Carbon;
use tidy;


class PriceFinder {

  public function getTotalCost(array $products, Store $store) {

    if (!is_array($products)) { return NULL; }//$products = array($products); }

    foreach($products as $item) {
      // Get the item cost at store
      $groceryitem = Groceryitem::where('factual_id', '=', $item['id'])->firstOrFail();
      if (!is_null($groceryitem->id))  {
        $itemprice = $this->getItemPriceAtStore($groceryitem, $store);
        // compute total cost
        $itemcost = $this->getItemCost($itemprice, $item['quantity']);
      }
      
    }

    return "";

  }

  public function getItemPriceAtStore(Groceryitem $item, Store $store) {
  
  }

  public function getItemCost(Groceryitem $item, $quantity) {
  
  
  
  }

  public function getGasCost($distance, $priceperliter) {
  
  }


}

