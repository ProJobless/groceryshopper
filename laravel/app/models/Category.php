<?php

use Illuminate\Support\Facades\URL; # not sure why i need this here :c
use Robbo\Presenter\PresentableInterface;
use Carbon\Carbon;

class Category extends Eloquent implements PresentableInterface {
	protected $guarded = array();

	public static $rules = array(
		'name' => 'required',
		'rank' => 'required'
  );

  public function getPresenter()
  {
        return new GroceryitemPresenter($this);
  }

  public function delete()
  {
      //Delete the store
      return parent::delete();
  }
  /**
   * Groceryitem relationship
   */
  public function groceryitems() {
      return $this>belongsToMany('Groceryitem', 'groceryitem_id');
  }

}
