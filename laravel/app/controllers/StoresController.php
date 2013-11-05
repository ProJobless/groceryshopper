<?php

class StoresController extends BaseController {

    /**
     * Store Repository
     *
     * @var Store
     */
    protected $store;

    public function __construct(Store $store)
    {
        $this->store = $store;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $stores = $this->store->all();
        return View::make('site/stores/stores.index', compact('stores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('stores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::all();
        $validation = Validator::make($input, Store::$rules);

        if ($validation->passes())
        {
            $this->store->create($input);

            return Redirect::route('stores.index');
        }

        return Redirect::route('stores.create')
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
        $store = $this->store->findOrFail($id);

        return View::make('stores.show', compact('store'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $store = $this->store->find($id);

        if (is_null($store))
        {
            return Redirect::route('stores.index');
        }

        return View::make('stores.edit', compact('store'));
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
        $validation = Validator::make($input, Store::$rules);

        if ($validation->passes())
        {
            $store = $this->store->find($id);
            $store->update($input);

            return Redirect::route('stores.show', $id);
        }

        return Redirect::route('stores.edit', $id)
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
        $this->store->find($id)->delete();

        return Redirect::route('stores.index');
    }

}
