<?php

class Store_addressesController extends BaseController {

	/**
	 * Store_address Repository
	 *
	 * @var Store_address
	 */
	protected $store_address;

	public function __construct(Store_address $store_address)
	{
		$this->store_address = $store_address;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$store_addresses = $this->store_address->all();

		return View::make('store_addresses.index', compact('store_addresses'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('store_addresses.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Store_address::$rules);

		if ($validation->passes())
		{
			$this->store_address->create($input);

			return Redirect::route('store_addresses.index');
		}

		return Redirect::route('store_addresses.create')
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
		$store_address = $this->store_address->findOrFail($id);

		return View::make('store_addresses.show', compact('store_address'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$store_address = $this->store_address->find($id);

		if (is_null($store_address))
		{
			return Redirect::route('store_addresses.index');
		}

		return View::make('store_addresses.edit', compact('store_address'));
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
		$validation = Validator::make($input, Store_address::$rules);

		if ($validation->passes())
		{
			$store_address = $this->store_address->find($id);
			$store_address->update($input);

			return Redirect::route('store_addresses.show', $id);
		}

		return Redirect::route('store_addresses.edit', $id)
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
		$this->store_address->find($id)->delete();

		return Redirect::route('store_addresses.index');
	}

}
