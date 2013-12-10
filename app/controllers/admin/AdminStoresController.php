<?php

class AdminStoresController extends AdminController {


    /**
     * Store Model
     * @var Store
     */
    protected $store;

    /**
     * Inject the models.
     * @param Post $store
     */
    public function __construct(Store $store)
    {
        parent::__construct();
        $this->store = $store;
    }

    /**
     * Show a list of all the stores.
     *
     * @return View
     */
    public function getIndex()
    {
        // Title
        $title = Lang::get('admin/stores/title.store_management');

        // Grab all the stores
        $stores = $this->store;

        // Show the page
        return View::make('admin/stores/index', compact('stores', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate()
    {
        // Title
        $title = Lang::get('admin/stores/title.create_a_new_store');

        // Show the page
        return View::make('admin/stores/create_edit', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function postCreate()
    {
        // Declare the rules for the form validation
        $rules = array(
            'title'   => 'required|min:3',
            'phone_1' => 'required',
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            // Create a new store
            $user = Auth::user();

            // Update the store post data
            $this->store->title            = Input::get('title');
            $this->store->slug             = Str::slug(Input::get('title'));
            $this->store->phone_1          = Input::get('phone_1');
            $this->store->phone_2          = Input::get('phone_2');
            $this->store->fax              = Input::get('fax');
            $this->store->url              = Input::get('url');
            $this->store->notes            = Input::get('notes');
            $store->searchable       = (Input::get('searchable'))  ?  TRUE: FALSE;


            // Was the store created?
            if($this->store->save())
            {
                //Fetch the latitude / longitude
                // Store the addess to the database
                // Save the address
                $address = new Store_address(
                    array(
                        'city'  => Input::get('city'),
                        'province_state' => Input::get('province_state'),
                        'postal_zip' => Input::get('postal_zip'),
                        'country' => Input::get('country'),
                        'line_2' => Input::get('line_2'),
                        'line_1' => Input::get('line_1'),
                        'latitude' => floatval(1.000),
                        'longitude' => floatval(1.000),
                        'store_id' => $store->id,
                    )
                );

                if($address->save()) {
                    // Redirect to the new store page
                    return Redirect::to('admin/stores/' . $store->id . '/edit')
                                ->with('success', Lang::get('admin/stores/messages.update.success'));
                }

                // Redirect to the new blog post page
                return Redirect::to('admin/stores/' . $this->store->id . '/edit')->with('success', Lang::get('admin/stores/messages.create.success'));
            }

            // Redirect to the blog post create page
            return Redirect::to('admin/stores/create')->with('error', Lang::get('admin/stores/messages.create.error'));
        }

        // Form validation failed
        return Redirect::to('admin/stores/create')->withInput()->withErrors($validator);
	}

    /**
     * Display the specified resource.
     *
     * @param $store
     * @return Response
     */
	public function getShow($store) {
        // redirect to the frontend
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param $store
     * @return Response
     */
	public function getEdit($store){
        // Title
        $title = Lang::get('admin/stores/title.store_update');

        // Show the page
        return View::make('admin/stores/create_edit', compact('store', 'title'));
	}

    /**
     * Update the specified resource in storage.
     *
     * @param $store
     * @return Response
     */
	public function postEdit($store) {

        // Declare the rules for the form validation
        $rules = array(
            'title'   => 'required',
            'phone_1' => 'required',
            'province_state' => 'required',
            'line_1' =>'required',
            'city' => 'required'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);


        // Check if the form validates with success
        if ($validator->passes())
        {
            // Update the store data
            $store->title   = Input::get('title');
            $name = Input::get('name');
            if (isset($name)){
                $store->slug = Input::get('name') ;
            }else {
                $store->slug = Str::slug(Input::get('title'));
            }
            $store->phone_1          = Input::get('phone_1');
            $store->phone_2          = Input::get('phone_2');
            $store->fax              = Input::get('fax');
            $store->url              = Input::get('url');
            $store->notes            = Input::get('notes');
            $store->searchable       = (Input::get('searchable') != NULL )  ?  1 : 0;
            $store->city = Input::get('city');
            $store->province_state = Input::get('province_state');
            $store->postal_zip = Input::get('postal_zip');
            $store->country = Input::get('country');
            $store->line_2 = Input::get('line_2');
            $store->line_1 = Input::get('line_1');
            $store->latitude = floatval(1.000);
            $store->longitude = floatval(1.000);

            // Was the store updated?
            if($store->save())
            {
                $store_id = $store->id;
                // Redirect to the new store page
                return Redirect::to('admin/stores/' . $store->id . '/edit')
                        ->with('success', Lang::get('admin/stores/messages.update.success'));

            }

            // Redirect to the store management page
            return Redirect::to('admin/stores/' . $store->id . '/edit')
                    ->with('error', Lang::get('admin/stores/messages.update.error'));
        }

        // Form validation failed
        return Redirect::to('admin/stores/' . $store->id . '/edit')
                ->withInput()->withErrors($validator);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param $store
     * @return Response
     */
    public function getDelete($store)
    {
        // Title
        $title = Lang::get('admin/stores/title.store_delete');

        // Show the page
        return View::make('admin/stores/delete', compact('store', 'title'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $store
     * @return Response
     */
    public function postDelete($store)
    {
        // Declare the rules for the form validation
        $rules = array(
            'id' => 'required|integer'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            $id = $store->id;
            $store->delete();

            //Delete the associated addresses

            // Was the store deleted?
            $store = Store::find($id);
            if(empty($store))
            {
                // Redirect to the store  management page
                return Redirect::to('admin/stores')
                    ->with('success', Lang::get('admin/stores/messages.delete.success'));
            }
        }
        // There was a problem deleting the store
        return Redirect::to('admin/stores')
            ->with('error', Lang::get('admin/stores/messages.delete.error'));
    }

    /**
     * Show a list of all the stores formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData()
    {
        $stores = Store::select(array('stores.id', 'stores.title', 'stores.slug',
                         'stores.phone_1', 'stores.line_1','stores.city', 'stores.province_state', 'stores.updated_at'));
        return Datatables::of($stores)
            ->add_column('actions', '<a href="{{{ URL::to(\'admin/stores/\' . $id . \'/edit\' ) }}}" class="btn btn-default btn-xs iframe" >{{{ Lang::get(\'button.edit\') }}}</a>
                <a href="{{{ URL::to(\'admin/stores/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger iframe">{{{ Lang::get(\'button.delete\') }}}</a>
            ')
            ->add_column('address', '<a href="{{{ URL::to(\'admin/stores/\' . $id . \'/edit\' ) }}}" class="btn btn-default btn-xs iframe" >{{{ Lang::get(\'button.edit\') }}}</a>
            ')
            ->remove_column('id')
            ->make();

    }

}
