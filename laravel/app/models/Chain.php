<?php

use Illuminate\Support\Facades\URL; # not sure why i need this here :c
use Robbo\Presenter\PresentableInterface;
use Carbon\Carbon;

class Chain extends Eloquent implements PresentableInterface {
	protected $guarded = array('id');


  public function getPresenter()
  {
        return new ChainPresenter($this);
  }

  public function delete()
  {
      //Delete the store
      return parent::delete();
  }
  /**
   * Store relationship
   */
  public function stores() {
      return $this->hasMany('Store');
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
