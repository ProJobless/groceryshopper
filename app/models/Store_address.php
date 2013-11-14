<?php

use Illuminate\Support\Facades\URL; # not sure why i need this here :c
use Robbo\Presenter\PresentableInterface;
use Carbon\Carbon;

class Store_address extends Eloquent implements PresentableInterface {
    protected $guarded = array('id');
    protected $fillable = array('line_1', 'store_id', 'line_2', 'city', 'province_state', 'country', 'postal_zip');

    public static $rules = array(
        'store_id' => 'required',
        'line_1' => 'required',
        'line_2' => 'required',
        'line_3' => 'required',
        'city' => 'required',
        'province_state' => 'required',
        'country' => 'required',
        'postal_zip' => 'required',
        'latitude' => 'required',
        'longitude' => 'required'
    );
    public function getPresenter() {
        return new Store_addressPresenter($this);
    }
    public function store() {
        return $this->belongsTo('Store', 'store_id');
    }
    /**
     * Get the post's author.
     *
     * @return User
     */
    public function user()
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
     * Returns the date of the blog post creation,
     * on a good and more readable format :)
     *
     * @return string
     */
    public function created_at()
    {
        return $this->date($this->created_at);
    }

    /**
     * Returns the date of the blog post last update,
     * on a good and more readable format :)
     *
     * @return string
     */
    public function updated_at()
    {
        return $this->date($this->updated_at);
    }

}
