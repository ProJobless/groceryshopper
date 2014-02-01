<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/** ------------------------------------------
 *  Route model binding
 *  ------------------------------------------
 */
Route::model('user', 'User');
Route::model('role', 'Role');
Route::model('store', 'Store');
Route::model('permission', 'Permission');
Route::model('groceryitem', 'Groceryitem');
Route::model('unit', 'Unit');

/** ------------------------------------------
 *  Admin Routes
 *  ------------------------------------------
 */
Route::group(array('prefix' => 'admin', 'before' => 'auth'), function()
{

    # Store Management
    Route::get('stores/{store}/show', 'AdminStoresController@getShow')
        ->where('store', '[0-9]+');
    Route::get('stores/{store}/edit', 'AdminStoresController@getEdit')
        ->where('store', '[0-9]+');
    Route::post('stores/{store}/edit', 'AdminStoresController@postEdit')
        ->where('store', '[0-9]+');
    Route::get('stores/{store}/delete', 'AdminStoresController@getDelete')
        ->where('store', '[0-9]+');
    Route::post('stores/{store}/delete', 'AdminStoresController@postDelete')
        ->where('store', '[0-9]+');
    Route::controller('stores', 'AdminStoresController');

    # Groceryitem Management
    Route::get('groceryitems/{groceryitem}/show', 'AdminGroceryitemsController@getShow')
        ->where('groceryitem', '[0-9]+');
    Route::get('groceryitems/{groceryitem}/edit', 'AdminGroceryitemsController@getEdit')
        ->where('groceryitem', '[0-9]+');
    Route::post('groceryitems/{groceryitem}/edit', 'AdminGroceryitemsController@postEdit')
        ->where('groceryitem', '[0-9]+');
    Route::get('groceryitems/{groceryitem}/delete', 'AdminGroceryitemsController@getDelete')
        ->where('groceryitem', '[0-9]+');
    Route::post('groceryitems/{groceryitem}/delete', 'AdminGroceryitemsController@postDelete')
        ->where('groceryitem', '[0-9]+');
    Route::controller('groceryitems', 'AdminGroceryitemsController');


    # User Management
    Route::get('users/{user}/show', 'AdminUsersController@getShow')
        ->where('user', '[0-9]+');
    Route::get('users/{user}/edit', 'AdminUsersController@getEdit')
        ->where('user', '[0-9]+');
    Route::post('users/{user}/edit', 'AdminUsersController@postEdit')
        ->where('user', '[0-9]+');
    Route::get('users/{user}/delete', 'AdminUsersController@getDelete')
        ->where('user', '[0-9]+');
    Route::post('users/{user}/delete', 'AdminUsersController@postDelete')
        ->where('user', '[0-9]+');
    Route::controller('users', 'AdminUsersController');

    # User Role Management
    Route::get('roles/{role}/show', 'AdminRolesController@getShow')
        ->where('role', '[0-9]+');
    Route::get('roles/{role}/edit', 'AdminRolesController@getEdit')
        ->where('role', '[0-9]+');
    Route::post('roles/{role}/edit', 'AdminRolesController@postEdit')
        ->where('role', '[0-9]+');
    Route::get('roles/{role}/delete', 'AdminRolesController@getDelete')
        ->where('role', '[0-9]+');
    Route::post('roles/{role}/delete', 'AdminRolesController@postDelete')
        ->where('role', '[0-9]+');
    Route::controller('roles', 'AdminRolesController');

    # Product Unit Management
    Route::get('units/{unit}/show', 'AdminUnitsController@getShow')
        ->where('unit', '[0-9]+');
    Route::get('units/{unit}/edit', 'AdminUnitsController@getEdit')
        ->where('unit', '[0-9]+');
    Route::post('units/{unit}/edit', 'AdminunitsController@postEdit')
        ->where('unit', '[0-9]+');
    Route::get('units/{unit}/delete', 'AdminUnitsController@getDelete')
        ->where('unit', '[0-9]+');
    Route::post('units/{unit}/delete', 'AdminUnitsController@postDelete')
        ->where('unit', '[0-9]+');
    Route::controller('units', 'AdminUnitsController');

    # Permission Management
    Route::get('permissions/{permission}/show', 'AdminPermissionsController@getShow')
        ->where('permission', '[0-9]+');
    Route::get('permissions/{permission}/edit', 'AdminPermissionsController@getEdit')
        ->where('permission', '[0-9]+');
    Route::post('permissions/{permission}/edit', 'AdminPermissionsController@postEdit')
        ->where('permission', '[0-9]+');
    Route::get('permissions/{permission}/delete', 'AdminPermissionsController@getDelete')
        ->where('permission', '[0-9]+');
    Route::post('permissions/{permission}/delete', 'AdminPermissionsController@postDelete')
        ->where('permission', '[0-9]+');
    Route::controller('permissions', 'AdminPermissionsController');

    # Admin Dashboard
    Route::controller('/', 'AdminDashboardController');
});


/** ------------------------------------------
 *  Frontend Routes
 *  ------------------------------------------
 */

// User reset routes
Route::get('user/reset/{token}', 'UserController@getReset')
  ->where('token', '[0-9a-z]+');

// User password reset
Route::post('user/reset/{token}', 'UserController@postReset')
  ->where('token', '[0-9a-z]+');

//:: User Account Routes ::
Route::post('user/{user}/edit', 'UserController@postEdit')
    ->where('user', '[0-9]+');

//:: User Account Routes ::
Route::post('user/login', 'UserController@postLogin');

# User RESTful Routes (Login, Logout, Register, etc)
Route::controller('user', 'UserController');

//:: Application Routes ::

# Filter for detect language
Route::when('contact-us','detectLang');

# Contact Us Static Page
Route::get('contact-us', function()
{
    // Return about us page
    return View::make('site/contact-us');
});

// about page (app/views/about.blade.php)
Route::get('about',array('as' => 'about', function()
{
  return View::make('site/about');
}));


# Search routes
Route::group(array('prefix' => 'products'), function()
{
    Route::get('search/{keyword}', array( 'uses' => 'SearchController@getSearch'))
        ->where('keyword', '[0-9a-z]+');
    Route::get('search/{keyword}/results', array( 'uses' => 'SearchController@getSearch'))
        ->where('keyword', '[0-9a-z]+');
    Route::get('search/{keyword}/results/{page}', array( 'uses' => 'SearchController@getSearch'))
        ->where('keyword', '[0-9a-z]+');
    Route::post('search', array( 'uses' => 'SearchController@processSearch', 'before' => 'csrf'));
});


# Shopping list routes
Route::group(array('prefix' => 'shoppinglist'), function()
  {

    # Shopping list show the list of items
    Route::get('/{cart_id}', 'ShoppingListController@getShow');

   # Posted route
    Route::post('/{cart_id}', 'ShoppingListController@postShow');

    # shoppinglist controller
    Route::get('/', 'ShoppingListController@getIndex');
  } 
);

Route::resource('stores', 'StoresController');

Route::resource('groceryitems', 'GroceryitemsController');

Route::resource('categories', 'CategoriesController');

Route::resource('units', 'UnitsController');

# Index Page - Last route, no matches
Route::get('/', array('before' => 'detectLang','uses' => 'HomeController@getIndex'));
