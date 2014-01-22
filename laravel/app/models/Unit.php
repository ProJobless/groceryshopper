<?php
use Illuminate\Support\Facades\URL; # not sure why i need this here :c
use Robbo\Presenter\PresentableInterface;
use Carbon\Carbon;

class Unit extends Eloquent implements PresentableInterface {
	protected $guarded = array('id');

  public static $rules = array();

  /**
    * Post relationship
    */
  public function groceryitems()
  {
      return $this->hasMany('Groceryitem');
  }
  public function getPresenter()
  {
        return new UnitPresenter($this);
  }

  public function delete()
  {
      //Delete the store
      return parent::delete();
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
