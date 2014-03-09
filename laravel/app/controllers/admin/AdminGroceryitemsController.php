<?php

class AdminGroceryitemsController extends AdminController {

    /**
     * Groceryitem Model
     * @var Groceryitem
     */
  protected $groceryitem;

    /**
     * Category Model
     * @var Category
     */
    protected $category;

    /**
     * Store Model
     * @var Store
     */
  protected $store;

    /**
     * Unit Model
     * @var Unit
     */
    protected $unit;

    /**
     * Inject the models.
     * @param Groceryitem $groceryitem
     */
    public function __construct(Groceryitem $groceryitem, Category $category, Store $store, Unit $unit)
    {
        parent::__construct();
        $this->groceryitem = $groceryitem;
        $this->store = $store;
        $this->unit = $unit;
        $this->category = $category;
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

        // All categories
        $categories = $this->category->all();

        // All the stores..
        $stores = $this->store->all();

        // All the units
        $units = $this->unit->all();
        
        // Selected groups
        $selectedStores = Input::old('stores', array());

        // Selected permissions
        $selectedCategories = Input::old('categories', array());

        // Selected units
        $selectedUnits = Input::old('units', array());

        // Mode
        $mode = 'create';
        return View::make('admin/groceryitems/create_edit', compact('units', 'categories', 'stores', 'selectedStores', 'selectedUnits', 'selectedCategories', 'title', 'mode'));
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
            'product_name'   => 'required',
            'brand' => 'required',
            'manufacturer' => 'required',
       );

      // Validate the inputs

      $validator = Validator::make(Input::all(), $rules);


        // Check if the form validates with success
        if ($validator->passes())
        {
            // Create a new user
            $user = Auth::user();

          // Get the inputs, with some exceptions
          $inputs = Input::except('csrf_token');
            // Update the groceryitem post data
            $this->groceryitem->title  = Input::get('product_name');
            $this->groceryitem->factual_id  = 'xxxx-local-xxx';
            $this->groceryitem->factual_url = "http://www.groceryshopper.ca";
            $this->groceryitem->unit_id = Input::get('unit_id');
            $this->groceryitem->size = Input::get('size');
            $this->groceryitem->upc = Input::get('upc');
            $this->groceryitem->manufacturer = Input::get('manufacturer');

            // Save if valid. Password field will be hashed before save
            $this->groceryitem->save();

            // Was the store created?
            if($this->groceryitem->save())
            {
                // Save the categories
              $this->groceryitem->saveCategories(Input::get( 'categories' ));

              // Save the stores and the related prices and 
              // quantities.
              $this->_save_store_info();

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
     * Save the store and groceryitem relationship data.
     *
     * @return Response
     */
    private function _save_store_info() {
        $store_info = array();
        foreach( Input::all() as $key => $val) {
          if(preg_match("/ID/", $key)) {
            $id = substr($key, 2, 1);
            $field = substr($key, 4);
            $store_info[$id][$field] = $val;
          }
        }
        // Add original item
        $store_info[1]['store_id'] = Input::get('store_id');
        $store_info[1]['quantity'] = Input::get('quantity');
        $store_info[1]['price'] = Input::get('price');

        var_dump($store_info);die();
      
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
        $title = Lang::get('admin/groceryitems/title.groceryitem_update');
        // Mode
        $mode = 'edit';

        // Show the page
        return View::make('admin/groceryitems/create_edit', compact('groceryitem', 'title', 'mode'));
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
                return Redirect::to('admin/groceryitems/' . $groceryitem->id . '/edit')
                        ->with('success', Lang::get('admin/groceryitems/messages.update.success'));

            }
            // Redirect to the store management page
            return Redirect::to('admin/groceryitems/' . $groceryitem->id . '/edit')
                    ->with('error', Lang::get('admin/groceryitems/messages.update.error'));
        }
        // Form validation failed
        return Redirect::to('admin/groceryitems/' . $groceryitem->id . '/edit')
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
        $title = Lang::get('admin/groceryitems/title.store_delete');

        // Show the page
        return View::make('admin/groceryitems/delete', compact('store', 'title'));
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
                    ->with('success', Lang::get('admin/groceryitems/messages.delete.success'));
            }
        }
        // There was a problem deleting the store
        return Redirect::to('admin/stores')
            ->with('error', Lang::get('admin/groceryitems/messages.delete.error'));
    }

    /**
     * Show a list of all the stores formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData()
    {
        $groceryitems = Groceryitem::select(array('groceryitems.id', 'groceryitems.image_url', 'groceryitems.title', 'groceryitems.brand','groceryitems.manufacturer', 'groceryitems.unit_id', 'groceryitems.size', 'groceryitems.factual_id', 'groceryitems.upc', 'groceryitems.updated_at'));
        return Datatables::of($groceryitems)
          ->edit_column('image_url', '<a href="{{{ URL::to($image_url) }}}"><img width="80px" height="80px" src="{{{ URL::to($image_url) }}}" /></a>')
          ->edit_column('unit_size', '{{ join("", array($unit_id, $size)) }}' )
            ->add_column('actions', '<a href="{{{ URL::to(\'admin/groceryitems/\' . $id . \'/edit\' ) }}}" class="btn btn-default btn-xs iframe" >{{{ Lang::get(\'button.edit\') }}}</a>
                <a href="{{{ URL::to(\'admin/groceryitems/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger iframe">{{{ Lang::get(\'button.delete\') }}}</a>
                ')
            ->remove_column('id')
            ->remove_column('unit_id')
            ->remove_column('upc')
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
