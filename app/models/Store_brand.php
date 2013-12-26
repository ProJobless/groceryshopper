<?php

class Store_brand extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'name' => 'required',
		'url' => 'required',
		'notes' => 'required'
	);
}
