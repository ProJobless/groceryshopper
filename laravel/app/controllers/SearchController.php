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
			$results = $this->_perform_search($keyword);
			return View::make('site/search-results');
		
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

	
	
	private function _perform_search($keyword) {
		// echo the data
		
		$tableName = "products-cpg";

		$auth_key = "3cq3h0MUUOAuD7T0M2FyGWWkd5ouNbsbhszvQF5B";
		$auth_secret = "XjKHXlgMPlVPcpbD6y3jyIiSKkBjZFCX58vPSQqV";
		require_once('../vendor/factual-php-driver/Factual.php');
		$factual = new Factual($auth_key,$auth_secret);
		
		//Search for products containing the word "shampoo"
		$query = new FactualQuery;
		$query->field("product_name")->search($keyword); 
		$query->sortAsc("product_name");
		$res = $factual->fetch($tableName, $query); 
		return ($res->getData());
		
		
		$res = $factual->schema("places");
		print_r($res->getColumnSchemas());
	}
}
