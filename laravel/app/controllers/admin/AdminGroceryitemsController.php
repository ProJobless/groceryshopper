<?php

class AdminGroceryitemsController extends AdminController {


    /**
     * Groceryitem Model
     * @var Groceryitem
     */
    protected $groceryitem;

    /**
     * Inject the models.
     * @param Groceryitem $groceryitem
     */
    public function __construct(Groceryitem $groceryitem)
    {
        parent::__construct();
        $this->groceryitem = $groceryitem;
    }

    /**
     * Show a list of all the stores.
     *
     * @return View
     */
    public function getIndex()
    {
        // Title
        $title = Lang::get('admin/groceryitems/title.groceryitems_management');
        var_dump($title);
        // Grab all the Groceryitems
        $groceryitems = $this->groceryitem;
        // Show the page
        return View::make('admin/groceryitems/index', compact('groceryitems', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate()
    {
        // Title
        $title = Lang::get('admin/groceryitems/title.create_a_new_groceryitem');
        // Show the page
        return View::make('admin/groceryitems/create_edit', compact('title'));
    }

    /**
     * Groceryitem a newly created resource in storage.
     *
     * @return Response
     */
    public function postCreate()
    {
        // Declare the rules for the form validation
        $rules = array(
            'title'   => 'required|min:3',
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            // Create a new store
            $user = Auth::user();

            // Update the store post data
            $this->groceryitem->title            = Input::get('title');


            // Was the store created?
            if($this->groceryitem->save())
            {
                // Redirect to the new item page
                return Redirect::to('admin/groceryitems/' . $this->groceryitem->id . '/edit')
                        ->with('success', Lang::get('admin/groceryitems/messages.create.success'));
            }

            // Redirect to the  create page
            return Redirect::to('admin/groceryitems/create')
                    ->with('error', Lang::get('admin/groceryitems/messages.create.error'));
        }

        // Form validation failed
        return Redirect::to('admin/groceryitems/create')->withInput()->withErrors($validator);
    }

    /**
     * Display the specified resource.
     *
     * @param $groceryitem
     * @return Response
     */
    public function getShow($groceryitem) {
        // redirect to the frontend
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $groceryitem
     * @return Response
     */
    public function getEdit($groceryitem){
        // Title
        $title = Lang::get('admin/groceryitems/title.store_update');

        // Show the page
        return View::make('admin/groceryitems/create_edit', compact('store', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $groceryitem
     * @return Response
     */
    public function postEdit($groceryitem) {

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
            $groceryitem->title   = Input::get('title');
            $name = Input::get('name');
            if (isset($name)){
                $groceryitem->slug = Input::get('name') ;
            }else {
                $groceryitem->slug = Str::slug(Input::get('title'));
            }
            $groceryitem->phone_1          = Input::get('phone_1');
            $groceryitem->searchable       = (Input::get('searchable') != NULL )  ?  1 : 0;

            // We need the latitude and longitude based on the
            // province, country and city OR postal code
            if( isset($groceryitem->city) && isset($store->province_state)
                    && isset($groceryitem->country) ){
                            $coordinate = $this->fetchCoords($groceryitem);
                            $groceryitem->latitude = $coordinate->getLatitude();
                            $groceryitem->longitude = $coordinate->getlongitude();

            }

            // Was the store updated?
            if($groceryitem->save())
            {
                $groceryitem_id = $store->id;
                // Redirect to the new store page
                return Redirect::to('admin/stores/' . $groceryitem->id . '/edit')
                        ->with('success', Lang::get('admin/stores/messages.update.success'));

            }
            // Redirect to the store management page
            return Redirect::to('admin/stores/' . $groceryitem->id . '/edit')
                    ->with('error', Lang::get('admin/stores/messages.update.error'));
        }
        // Form validation failed
        return Redirect::to('admin/stores/' . $groceryitem->id . '/edit')
                ->withInput()->withErrors($validator);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param $groceryitem
     * @return Response
     */
    public function getDelete($groceryitem)
    {
        // Title
        $title = Lang::get('admin/stores/title.store_delete');

        // Show the page
        return View::make('admin/stores/delete', compact('store', 'title'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $groceryitem
     * @return Response
     */
    public function postDelete($groceryitem)
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
            $id = $groceryitem->id;
            $groceryitem->delete();

            //Delete the associated addresses

            // Was the store deleted?
            $groceryitem = Groceryitem::find($id);
            if(empty($groceryitem))
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
        $groceryitems = Groceryitem::select(array('stores.id', 'stores.title', 'stores.slug',
                         'stores.phone_1', 'stores.line_1','stores.province_state', 'stores.city', 'stores.country', 'stores.postal_zip', 'stores.province_state as address', 'stores.updated_at'));
        return Datatables::of($groceryitems)
            ->edit_column('address', '{{ join("<br />", array($line_1, $city, $province_state." ".$country, $postal_zip)) }}' )

            ->add_column('actions', '<a href="{{{ URL::to(\'admin/stores/\' . $id . \'/edit\' ) }}}" class="btn btn-default btn-xs iframe" >{{{ Lang::get(\'button.edit\') }}}</a>
                <a href="{{{ URL::to(\'admin/stores/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger iframe">{{{ Lang::get(\'button.delete\') }}}</a>
            ')
            ->remove_column('id')
            ->remove_column('city')
            ->remove_column('province_state')
            ->remove_column('country')
            ->make();

    }

    function _build_address($groceryitems) {
        return "Groceryitem address";
   }

    private function fetchCoords($groceryitem) {

            $geocoder = new \Geocoder\Geocoder();
            $adapter  = new \Geocoder\HttpAdapter\CurlHttpAdapter();
            $chain    = new \Geocoder\Provider\ChainProvider(array(
                        new \Geocoder\Provider\GoogleMapsProvider($adapter, 'ca_EN', 'Canada', true),
            ));
            $geocoder->registerProvider($chain);
            //Fetch the address from google maps.
            $address = $groceryitem->line_1." ".$store->line_2." ".$store->city.", ".
                        $groceryitem->province_state.", ".$store->country.", ".$store->postal_zip;
            return $geocoder->geocode($address);

    }

}
