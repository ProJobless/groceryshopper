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

class HomeController extends BaseController {
    /**
     * User Model
     * @var User
     */
    protected $user;

    public function __construct(User $user)
    {
        parent::__construct();

        $this->user = $user;
    }
    /**
     * Returns all the blog posts.
     *
     * @return View
     */
    public function getIndex()
    {
      // Show the page
      // Generate a new token/cart_id for every page visit
      // based on ip address and time of day.
      $cart_id = 'cart-' . csrf_token();
      return View::make('site/index', compact('cart_id'));
    }
}
