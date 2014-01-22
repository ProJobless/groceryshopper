<?php
use Illuminate\Support\Facades\URL; # not sure why i need this here :c
use Robbo\Presenter\PresentableInterface;
use Carbon\Carbon;


class Groceryitem extends Eloquent implements PresentableInterface {
  protected $guarded = array('id');

  protected $fillable = array(
    'title', 'name', 'factual_avg_price', 'factual_brand', 'factual_id', 'factual_upc',
  );
  public static $rules = array(
      'name' => 'required',
      'title' => 'required',
      'factual_id' => 'required',
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
  *  Store relationship
  */
  public function stores()
  {
    return $this->belongsToMany('Store', 'groceryitem_store', 'groceryitem_id', 'store_id')
      ->withPivot('quantity','price');

  }

  /**
   * Category relationship
   */
  public function categories() {
      return $this->belongsToMany('Category', 'category_groceryitem', 'groceryitem_id', 'category_id');
  }

  /**
   * Unit relationship
   */
  public function units() {
      return $this->belongsTo('Unit', 'unit_id');
  }

  /**
   * Get the store author.
   *
   * @return User
   */
  public function author()
  {
      return $this->belongsTo('User', 'user_id');
  }

  /**
   * Get the URL to the post.
   *
   * @return string
   */
  public function url()
  {
      return Url::to($this->name);
  }

  public function shoppinglist() {
    // body...
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
