<?php

use Illuminate\Support\Facades\URL; // not sure why i need this here :c
use Robbo\Presenter\PresentableInterface;

class Product extends Eloquent implements PresentableInterface {

    /**
     * Deletes a product and all
     * the associated info
     *
     * @return bool
     */
    public function delete()
    {
        // Delete the product
        return parent::delete();
    }

    /**
     * Returns a formatted post content entry,
     * this ensures that line breaks are returned.
     *
     * @return string
     */
    public function content()
    {
        return nl2br($this->content);
    }

    /**
     * Get the product's author.
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
     * Get the URL to the product.
     *
     * @return string
     */
    public function url()
    {
                return Url::to($this->slug);
    }

	/**
	 * Returns the date of the product creation,
	 * on a good and more readable format :)
	 *
	 * @return string
	 */
	public function created_at()
	{
		return $this->date($this->created_at);
	}

	/**
	 * Returns the date of the product last update,
	 * on a good and more readable format :)
	 *
	 * @return string
	 */
    public function updated_at()
    {
        return $this->date($this->updated_at);
    }

    public function getPresenter()
    {
        return new ProductPresenter($this);
    }

}
