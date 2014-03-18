<?php

class AdminUnitsController extends AdminController {


    /**
     * User Model
     * @var User
     */
    protected $user;

    /**
     * unit Model
     * @var unit
     */
    protected $unit;

    /**
     * Permission Model
     * @var Permission
     */
    protected $permission;

    /**
     * Inject the models.
     * @param User $user
     * @param unit $unit
     */
    public function __construct(User $user, Unit $unit)
    {
        parent::__construct();
        $this->user = $user;
        $this->unit = $unit;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {
        // Title
        $title = Lang::get('admin/units/title.unit_management');

        // Grab all the groups
        $units = $this->unit;

        // Show the page
        return View::make('admin/units/index', compact('units', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
  public function getCreate()
  {

    // Title
    $title = Lang::get('admin/units/title.create_a_new_unit');
    // Mode
    $mode = 'create';

    // Show the page
    return View::make('admin/units/create_edit', compact('title', 'mode'));
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
            'title' => 'required',
            'symbol' => 'required'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);
        // Check if the form validates with success
        if ($validator->passes())
        {
            // Get the inputs, with some exceptions
            $inputs = Input::except('csrf_token');

            $this->unit->name = Str::slug($inputs['title']);
            $this->unit->symbol = $inputs['symbol'];
            $this->unit->title = $inputs['title'];
            $this->unit->save();


            // Was the unit created?
            if ($this->unit->id)
            {
                // Redirect to the new unit page
                return Redirect::to('admin/units/')->with('success', Lang::get('admin/units/messages.create.success'));
            }

            // Redirect to the unit create page
            return Redirect::to('admin/units/create')->withInput()->with('error', Lang::get('admin/units/messages.' . $error));
        }

        // Form validation failed
        return Redirect::to('admin/units/create')->withInput()->withErrors($validator);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return Response
     */
    public function getShow($id)
    {
        // redirect to the frontend
    }

  /**
   * Show the form for editing the specified resource.
   *
   * @param $unit
   * @return Response
   */
  public function getEdit($unit)
  {
    if(empty($unit)) {
      // Redirect to the units management page
      return Redirect::to('admin/units')->with('error', Lang::get('admin/units/messages.does_not_exist'));
    }

    // Title
    $title = Lang::get('admin/units/title.unit_update');
    // Mode
    $mode = 'create';


    // Show the page
    return View::make('admin/units/create_edit', compact('unit', 'mode', 'title'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param $unit
   * @return Response
   */
  public function postEdit($unit)
  {
      // Declare the rules for the form validation
      $rules = array(
          'name' => 'required',
          'title' => 'required',
          'symbol' => 'required',
      );

      // Validate the inputs
      $validator = Validator::make(Input::all(), $rules);

      // Check if the form validates with success
      if ($validator->passes())
      {
        // Update the unit data
        $name = Input::get('name');
          $unit->name        = isset($name) ? strtolower($name) : Str::slug(Input::get('title'));
          $unit->title        = Input::get('title');
          $unit->symbol       = Input::get('symbol');

          // Was the unit updated?
          if ($unit->save())
          {
              // Redirect to the unit page
              return Redirect::to('admin/units/')->with('success', Lang::get('admin/units/messages.update.success'));
          }
          else
          {
              // Redirect to the unit page
              return Redirect::to('admin/units/' . $unit->id . '/edit')->with('error', Lang::get('admin/units/messages.update.error'));
          }
      }

      // Form validation failed
      return Redirect::to('admin/units/' . $unit->id . '/edit')->withInput()->withErrors($validator);
  }


    /**
     * Remove user page.
     *
     * @param $unit
     * @return Response
     */
    public function getDelete($unit)
    {
        // Title
        $title = Lang::get('admin/units/title.unit_delete');

        // Show the page
        return View::make('admin/units/delete', compact('unit', 'title'));
    }

    /**
     * Remove the specified user from storage.
     *
     * @param $unit
     * @internal param $id
     * @return Response
     */
    public function postDelete($unit)
    {
            // Was the unit deleted?
            if($unit->delete()) {
                // Redirect to the unit management page
                return Redirect::to('admin/units')->with('success', Lang::get('admin/units/messages.delete.success'));
            }

            // There was a problem deleting the unit
            return Redirect::to('admin/units')->with('error', Lang::get('admin/units/messages.delete.error'));
    }

    /**
     * Show a list of all the units formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData()
    {
       $units = unit::select(array('units.id',  'units.name', 'units.title', 'units.symbol', 'units.updated_at'));

       return Datatables::of($units)
        ->edit_column('updated_at','{{{ Carbon::now()->diffForHumans(Carbon::createFromTimestamp(strtotime($updated_at))) }}}')
        ->add_column('actions', '<a href="{{{ URL::to(\'admin/units/\' . $id . \'/edit\' ) }}}" class="btn btn-xs btn-default">{{{ Lang::get(\'button.edit\') }}}</a>
                <a href="{{{ URL::to(\'admin/units/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger">{{{ Lang::get(\'button.delete\') }}}</a>
        ')
        ->remove_column('name')
        ->make();
    }

}
