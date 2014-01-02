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
			
			return View::make('site/search/search-results', compact('results', 'rowcount', 'total_pages', 'page'));
		
		}
        // There was a problem deleting the store
		return Redirect::to('search')
            ->with('error', Lang::get('admin/stores/messages.delete.error'));

		


	}

	public function getSearch($keyword) 
	{
		// echo the data
		print_r($keyword);
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
		require_once ('../app/libraries/Factual/Factual/Factual.php');
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
		print_r($res->getRowCount());
		return array ("data" => $res->getData(), "rowcount" => $res->getRowCount());
	}
}
