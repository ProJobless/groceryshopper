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

  /**
   * Get the date the groceryitem was created.
   *
   * @param \Carbon|null $date
   * @return string
   */
  public function date($date=null)
  {
      if(is_null($date)) {
          $date = $this->created_at;
      }

      return String::date($date);
  }

    /**
     * Returns the date of the store creation,
     * on a good and more readable format :)
     *
     * @return string
     */
    public function created_at()
    {
        return $this->date($this->created_at);
    }

    /**
     * Returns the date of the store last update,
     * on a good and more readable format :)
     *
     * @return string
     */
    public function updated_at()
    {
        return $this->date($this->updated_at);
    }

}
