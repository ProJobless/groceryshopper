<?php
/**
 * Search controller
 *
 * Allows you to search tags, users, and by keywords
 *
 * @license     http://www.opensource.org/licenses/mit MIT License
 * @copyright   UserScape, Inc. (http://userscape.com)
 * @author      UserScape Dev Team
 * @link        http://bundles.laravel.com
 * @package     Laravel-Bundles
 * @subpackage  Controllers
 * @filesource
 */

class SearchController extends BaseController {


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
        $this->beforeFilter('ajax', array('only' => 'store'));

        // Exit if not a valid _token.
        $this->beforeFilter('csrf', array('only' => 'store'));
    }
    /**
    * Search index
    *
    * Used by keyword searching.
    */
    public function getIndex()
    {
    // Show the page

        return View::make('site/index');
    }
    /**
	 * Used by keyword searching
     *
     */
	public function processSearch()
    {
        // Validate the inputs
        // Declare the rules for the form validation
        $rules = array(
            'keyword' => 'required'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            $keyword  = Input::get('keyword');
            $page = Input::get('page', 1);
            // Get the count and the data
            $offset = ($page * 20) - 20;

            $data = $this->_perform_search($keyword, $offset);
            $results  = $data['data'];
            $rowcount = $data['rowcount'];
            $total_pages = ceil($rowcount / 20);
            if ($page > $total_pages or $page < 1)
            {
                $page = 1;
            }

            //Save the search results.
            foreach($results as $result) {
                $this->saveDataToDb($result);
            }

            return View::make('site/search/search-results', compact('results', 'rowcount', 'total_pages', 'page'));

        }
        // There was a problem deleting the store
        return Redirect::to('search')
            ->with('error', Lang::get('admin/stores/messages.delete.error'));
    }

    public function getSearch($keyword)
    {
    }

    private function saveDataToDb($result) {
        // Load the module
      $groceryitem = new Groceryitem;
      $input = $result;
      $groceryitem->title = $result['product_name'];
      // Core details.
      $groceryitem->factual_id = $result['factual_id'];
      $groceryitem->factual_url = "http://www.factual.com";
      $groceryitem->factual_image_urls = isset($result['image_urls']) ? $result['image_urls']['0'] : NULL;
      $groceryitem->factual_brand = $result['brand'];
      $groceryitem->factual_product_name = $result['product_name'];
      $groceryitem->factual_upc = isset($result['upc']) ? $result['upc']: NULL;
      $groceryitem->factual_ean13 = isset($result['ean13']) ?  $result['ean13'] : NULL;
      $groceryitem->factual_category = $result['category'];
      $groceryitem->factual_avg_price = isset($result['avg_price']) ? $result['avg_price'] : NULL;
      //Other details.
      $groceryitem->factual_size = isset($result['size']) ? $result['size'][0] : NULL;
      $groceryitem->factual_manufacturer = isset($result['manufacturer']) ? $result['manufacturer'] : NULL;
      $groceryitem->factual_ingredients = isset($result['ingredients']) ? NULL : NULL;
      $groceryitem->factual_ingredients = isset($result['ingredients']) ? NULL : NULL;
      $groceryitem->factual_ingredients = isset($result['ingredients']) ? NULL : NULL;
      $groceryitem->factual_serving_size = isset($result['serving_size']) ? $result['serving_size'] : NULL;
      $groceryitem->factual_servings = isset($result['servings']) ? $result['servings'] : NULL;
      $groceryitem->factual_calories = isset($result['calories']) ? $result['calories'] : NULL;
      $groceryitem->factual_fat_calories = isset($result['fat_calories']) ? $result['fat_calories'] : NULL;
      $groceryitem->factual_total_fat = isset($result['total_fat']) ? $result['total_fat'] : NULL;
      $groceryitem->factual_sat_fat = isset($result['sat_fat']) ? $result['sat_fat'] : NULL;
      $groceryitem->factual_trans_fat = isset($result['trans_fat']) ? $result['trans_fat'] : NULL;
      $groceryitem->factual_cholesterol = isset($result['cholesterol']) ? $result['cholesterol'] : NULL;
      $groceryitem->factual_sodium = isset($result['sodium']) ? $result['sodium'] : NULL;
      $groceryitem->factual_potassium = isset($result['potassium']) ? $result['potassium'] : NULL;
      $groceryitem->factual_dietary_fiber = isset($result['dietary_fiber']) ? $result['dietary_fiber'] : NULL;
      $groceryitem->factual_sugars = isset($result['sugars']) ? $result['sugars'] : NULL;
      $groceryitem->factual_protein = isset($result['protein']) ? $result['protein'] : NULL;
      $groceryitem->factual_upc_e = isset($result['upc_e']) ? $result['upc_e'] : NULL;

      // System values
      $groceryitem->upc = isset($result['upc']) ? $result['upc'] : NULL;

      //Get the size
      $groceryitem->image_url = isset($result['image_urls']) ? $result['image_urls']['0'] : NULL;
      $groceryitem->brand = $result['brand'];
      $groceryitem->product_name = $result['product_name'];
      
      // Save the unit and size
      if(!isset($result['size'])) {
        $unit = Unit::where('name', '=', 'each')->first();
        $groceryitem->unit_id = $unit->id;
      }else {
        $this->_save_unit_size($groceryitem, $result['size'][0]);
      }

      // Save the category 
      $groceryitem->save();

    }

    private function _save_unit_size($groceryitem, $input) {
      $sizes = preg_split("/;/", $input);
      foreach($sizes as $size) {
        //list($value, $unit) = preg_split("/[\s]+/", trim($size));
        // Fetch only the values.
        $value = str_replace(['+', '-'], '', filter_var($size, FILTER_SANITIZE_NUMBER_FLOAT));
        $unitname = preg_replace('/[\d\s\.]/', '', trim($size));
        $values[] = array("value" => $value, "unit" => $unitname);

      }
      var_dump($values);
      $units = Unit::all();
      foreach($values as $value){
        //$unit = Unit::where('name', '=', $value['unit'])->get();
        $unit = Unit::where('symbol', '=', $value['unit'])->first();
        if (is_null($unit)) {
            $unit = new Unit();
            $unit->title = $value['unit'];
            $unit->name = $value['unit'];
            $unit->symbol = $value['unit'];
            $unit->save();
        }
        $groceryitem->unit_id  = $unit->id;
      }
      // Save the unit
      // get the unit
      var_dump($groceryitem);
    }


    /**
     * Show a list of all the search results formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData()
    {
    }



  private function _perform_search($keyword, $offset = 0) {
    // echo the data

    $tableName = "products-cpg-nutrition";

    $auth_key = "3cq3h0MUUOAuD7T0M2FyGWWkd5ouNbsbhszvQF5B";
    $auth_secret = "XjKHXlgMPlVPcpbD6y3jyIiSKkBjZFCX58vPSQqV";
    //require_once ('../vendor/factual-php-driver/Factual.php');
    require_once ('../app/libraries/factual-php-driver/Factual.php');
    $factual = new Factual($auth_key,$auth_secret);
    //Search for products containing the word "$keyword"
    $query = new FactualQuery;
    $query->field("product_name")->search($keyword);
    $query->field("category")->includesAny(array("Meat","Food", "Seafood", "tea"));
    $query->sortAsc("product_name");
    $query->limit(20);
    $query->includeRowCount();
    $query->offset($offset);
    $res = $factual->fetch($tableName, $query);
    return array ("data" => $res->getData(), "rowcount" => $res->getRowCount());
	}
}
