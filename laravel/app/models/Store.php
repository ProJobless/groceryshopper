<?php

use Illuminate\Support\Facades\URL; # not sure why i need this here :c
use Robbo\Presenter\PresentableInterface;
use Carbon\Carbon;

class Store extends Eloquent implements PresentableInterface {
    protected $guarded = array('id');
    protected $fillable = array('title', 'name');
    public static $rules = array(
        'name' => 'required',
        'title' => 'required',
        'phone_1' => 'required',
        'phone_2' => 'required',
        'fax' => 'required',
        'url' => 'required',
        'notes' => 'required',
        'searchable' => 'required'
    );

    public function getPresenter()
    {
        return new StorePresenter($this);
    }

    public function delete() {
        // Delete the address
        $this->addresses()->delete();

        //Delete the store
        return parent::delete();
    }

    public function addresses()
    {
        return $this->hasMany('Store_address');
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

    /**
     * Get the post's author.
     *
     * @return User
     */
    public function author()
    {
        return $this->belongsTo('User', 'user_id');
    }

    /**
     * Get the date the post was created.
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
