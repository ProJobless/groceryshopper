<?php

class AdminStoresController extends AdminController {

    /**
     * Chain Model
     * @var Chain
     */
    protected $chain;

    /**
     * Store Model
     * @var Store
     */
    protected $store;

    /**
     * Inject the models.
     * @param Post $store
     */
    public function __construct(Store $store, Chain $chain)
    {
        parent::__construct();
        $this->store = $store;
        $this->chain = $chain;
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
  public function getCreate() {
    // Title
    $title = Lang::get('admin/stores/title.create_a_new_store');

    // All chains
    $chains = $this->chain->all();

    // Selected chains
    $selectedChains = Input::old('chains', array());

    // Selected provinces
    $selectedProvinces = Input::old('province_state', array());

    // Selected countries
    $selectedCountries = Input::old('country', array());

    //  province_state
    $provinces =  $this->getProvinces();
      //  countries
    $countries  =  $this->getCountries();

    // Mode
    $mode = 'create';

    // Show the page
    return View::make('admin/stores/create_edit',
      compact('mode', 'title', 'chains', 'selectedChains',
      'selectedProvinces', 'provinces', 'countries', 'selectedCountries'
      )
    );
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
            'province_state' => 'required',
            'city' => 'required',
            'line_1' => 'required',
            'country' => 'required',
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
            $this->store->searchable       = (Input::get('searchable') != NULL )  ?  1 : 0;
            $this->store->city = Input::get('city');
            $this->store->province_state = Input::get('province_state');
            $this->store->postal_zip = Input::get('postal_zip');
            $this->store->country = Input::get('country');
            $this->store->line_2 = Input::get('line_2');
            $this->store->line_1 = Input::get('line_1');

            $this->store->chain_id = Input::get('chain_id');
            // We need the latitude and longitude based on the 
            // province, country and city OR postal code
            if( isset($this->store->city) && isset($this->store->province_state) 
                    && isset($this->store->country) ){
                            $coordinate = $this->fetchCoords($this->store);
                            $this->store->latitude = $coordinate->getLatitude();
                            $this->store->longitude = $coordinate->getlongitude();

            }

            // Was the store created?
            if($this->store->save())
            {

                // Redirect to the new store page
                return Redirect::to('admin/stores/' . $this->store->id . '/edit')
                        ->with('success', Lang::get('admin/stores/messages.create.success'));
            }

            // Redirect to the blog post create page
            return Redirect::to('admin/stores/create')
                    ->with('error', Lang::get('admin/stores/messages.create.error'));
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

    // All chains
    $chains = $this->chain->all();
  foreach($chains as $chain) {
    var_dump($chain->name);
  }
    // Selected chains
    $selectedChains = Input::old('chains', array());
    var_dump($selectedChains);

    // Selected provinces
    $selectedProvinces = Input::old('province_state', array());

    // Selected countries
    $selectedCountries = Input::old('country', array());

    $provinces = $this->getProvinces();

    $countries = $this->getCountries();
    // Mode
    $mode = 'edit';

    // Show the page
    return View::make('admin/stores/create_edit',
      compact( 'store', 'mode', 'title', 'chains', 'selectedChains',
      'selectedProvinces', 'provinces', 'countries', 'selectedCountries'
      )
    );
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
            $store->fax              = Input::get('fax');
            $store->url              = Input::get('url');
            $store->notes            = Input::get('notes');
            $store->searchable       = (Input::get('searchable') != NULL )  ?  1 : 0;
            $store->city = Input::get('city');
            $store->province_state = Input::get('province_state');
            $store->postal_zip = Input::get('postal_zip');
            $store->country = Input::get('country');
            $store->line_1 = Input::get('line_1');

            // We need the latitude and longitude based on the 
            // province, country and city OR postal code
            if( isset($store->city) && isset($store->province_state) 
                    && isset($store->country) ){
                          $coordinate = $this->fetchCoords($store);
                          $store->latitude = $coordinate->getLatitude();
                          $store->longitude = $coordinate->getlongitude();

            }

            // Was the store updated?
            if($store->save())
            {
                $store_id = $store->id;
                // Redirect to the new store page
                return Redirect::to('admin/stores/' . $store->id . '/edit')
                        ->with('success', Lang::get('admin/stores/messages.update.success'));

            }
            // Redirect to the store management page
            return Redirect::to('admin/stores/')
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
                         'stores.phone_1', 'stores.line_1','stores.province_state', 'stores.city', 'stores.country', 'stores.postal_zip', 'stores.province_state as address', 'stores.updated_at'));
        return Datatables::of($stores)
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
	
    function _build_address($stores) {
		return "Store address";
   }

  private function fetchCoords($store) {

    $geocoder = new \Geocoder\Geocoder();
    $adapter  = new \Geocoder\HttpAdapter\CurlHttpAdapter();
    $chain    = new \Geocoder\Provider\ChainProvider(array(
                new \Geocoder\Provider\GoogleMapsProvider($adapter, 'ca_EN', 'Canada', true),
    ));

    $geocoder->registerProvider($chain);
    //Fetch the address from google maps.
    $address = $store->line_1." ".$store->line_2." ".$store->city.", ".
      $store->province_state.", ".$store->country.", ".$store->postal_zip;
    return $geocoder->geocode($address);

  }

  private function getCountries() {
    return array(
      "CA" => "Canada",
      "USA" => "USA"
    );
  }
  private function getProvinces(){
    return array (
      "QC" => "Quebec",
      "ON" => "Ontario"
    );
  }

}
