<?php

class Store_brandsController extends BaseController {

	/**
	 * Store_brand Repository
	 *
	 * @var Store_brand
	 */
	protected $store_brand;

	public function __construct(Store_brand $store_brand)
	{
		$this->store_brand = $store_brand;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$store_brands = $this->store_brand->all();

		return View::make('store_brands.index', compact('store_brands'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('store_brands.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Store_brand::$rules);

		if ($validation->passes())
		{
			$this->store_brand->create($input);

			return Redirect::route('store_brands.index');
		}

		return Redirect::route('store_brands.create')
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$store_brand = $this->store_brand->findOrFail($id);

		return View::make('store_brands.show', compact('store_brand'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$store_brand = $this->store_brand->find($id);

		if (is_null($store_brand))
		{
			return Redirect::route('store_brands.index');
		}

		return View::make('store_brands.edit', compact('store_brand'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = array_except(Input::all(), '_method');
		$validation = Validator::make($input, Store_brand::$rules);

		if ($validation->passes())
		{
			$store_brand = $this->store_brand->find($id);
			$store_brand->update($input);

			return Redirect::route('store_brands.show', $id);
		}

		return Redirect::route('store_brands.edit', $id)
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->store_brand->find($id)->delete();

		return Redirect::route('store_brands.index');
	}

}
