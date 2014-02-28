<?php

class GroceryitemsController extends BaseController {

    /**
     * Groceryitem Repository
     *
     * @var Groceryitem
     */
    protected $groceryitem;

    public function __construct(Groceryitem $groceryitem)
    {
        $this->groceryitem = $groceryitem;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $groceryitems = $this->groceryitem->all();


        return View::make('groceryitems.index', compact('groceryitems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('groceryitems.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::all();
        $validation = Validator::make($input, Groceryitem::$rules);

        if ($validation->passes())
        {
            $this->groceryitem->create($input);

            return Redirect::route('groceryitems.index');
        }

        return Redirect::route('groceryitems.create')
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
        $groceryitem = $this->product->findOrFail($id);

        return View::make('groceryitems.show', compact('product'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $groceryitem = $this->product->find($id);

        if (is_null($groceryitem))
        {
            return Redirect::route('groceryitems.index');
        }
        return View::make('groceryitems.edit', compact('product'));
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
        $validation = Validator::make($input, Groceryitem::$rules);

        if ($validation->passes())
        {
            $groceryitem = $this->product->find($id);
            $groceryitem->update($input);

            return Redirect::route('groceryitems.show', $id);
        }

        return Redirect::route('groceryitems.edit', $id)
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
        $this->product->find($id)->delete();

        return Redirect::route('groceryitems.index');
    }

}
