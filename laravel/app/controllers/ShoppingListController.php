<?php
/**
 * Search controller
 *
 * Allows you to search tags, users, and by keywords
 *
 * @license     http://www.opensource.org/licenses/mit MIT License
 * @link        http://bundles.laravel.com
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


    public function getShow() 
    {
    
      // Show the page.
      // Get the current token.

      return View::make('site/shoppinglist/index', compact('cart_id'));
    
    }

    public function postShow()
    {

      // We need to do a location detection,
      // so we can find out where the user is 
      // from.

      $cart_id = Input::get('cart_id');
      $token  = 'cart-'. bin2hex(openssl_random_pseudo_bytes(16));
      return View::make('site/shoppinglist/index', compact('cart_id'));
    
    }

    /**
     * Show a list of all the search results formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData()
    {
    }
}
