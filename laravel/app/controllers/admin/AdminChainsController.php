<?php

class AdminChainsController extends AdminController {

  /**
   * chain Model
   * @var chain
   */
  protected $chain;

  /**
   * Inject the models.
   * @param chain $chain
   */
  public function __construct(Chain $chain)
  {
    parent::__construct();
    $this->chain = $chain;
  }

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function getIndex()
  {
    // Title
    $title = Lang::get('admin/chains/title.chain_management');

    // Grab all the groups
    $chains = $this->chain;

    // Show the page
    return View::make('admin/chains/index', compact('chains', 'title'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function getCreate()
  {

    // Title
    $title = Lang::get('admin/chains/title.create_a_new_chain');
    // Mode
    $mode = 'create';

    // Show the page
    return View::make('admin/chains/create_edit', compact('title', 'mode'));
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
      'chain_name' => 'required',
      'url' => 'required'
    );

    // Validate the inputs
    $validator = Validator::make(Input::all(), $rules);
    // Check if the form validates with success
    if ($validator->passes())
    {
      // Get the inputs, with some exceptions
      $inputs = Input::except('csrf_token');

      $this->chain->alternate_name = $inputs['alternate_name'];
      $this->chain->url = $inputs['url'];
      $this->chain->chain_name = $inputs['chain_name'];
      $this->chain->save();

      // Was the chain created?
      if ($this->chain->id)
      {
        // Redirect to the new chain page
        return Redirect::to('admin/chains/')->with('success', Lang::get('admin/chains/messages.create.success'));
      }

        // Redirect to the chain create page
        return Redirect::to('admin/chains/create')->withInput()->with('error', Lang::get('admin/chains/messages.' . $error));
    }

    // Form validation failed
    return Redirect::to('admin/chains/create')->withInput()->withErrors($validator);
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
   * @param $chain
   * @return Response
   */
  public function getEdit($chain)
  {
    if(empty($chain)) {
      // Redirect to the chains management page
      return Redirect::to('admin/chains')->with('error', Lang::get('admin/chains/messages.does_not_exist'));
    }

    // Title
    $title = Lang::get('admin/chains/title.chain_update');
    // Mode
    $mode = 'edit';


    // Show the page
    return View::make('admin/chains/create_edit', compact('chain', 'mode', 'title'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param $chain
   * @return Response
   */
  public function postEdit($chain)
  {
      // Declare the rules for the form validation
      $rules = array(
          'chain_name' => 'required',
          'url' => 'required',
      );

      // Validate the inputs
      $validator = Validator::make(Input::all(), $rules);

      // Check if the form validates with success
      if ($validator->passes())
      {
        // Update the chain data
          $name = Input::get('alternate_name');
          $chain->alternate_name        = isset($name) ? strtolower($name) : Str::slug(Input::get('chain_name'));
          $chain->chain_name        = Input::get('chain_name');
          $chain->url       = Input::get('url');

          // Was the chain updated?
          if ($chain->save())
          {
              // Redirect to the chain page
              return Redirect::to('admin/chains/')->with('success', Lang::get('admin/chains/messages.update.success'));
          }
          else
          {
              // Redirect to the chain page
              return Redirect::to('admin/chains/' . $chain->id . '/edit')->with('error', Lang::get('admin/chains/messages.update.error'));
          }
      }

      // Form validation failed
      return Redirect::to('admin/chains/' . $chain->id . '/edit')->withInput()->withErrors($validator);
  }


    /**
     * Remove user page.
     *
     * @param $chain
     * @return Response
     */
    public function getDelete($chain)
    {
        // Title
        $title = Lang::get('admin/chains/title.chain_delete');

        // Show the page
        return View::make('admin/chains/delete', compact('chain', 'title'));
    }

    /**
     * Remove the specified user from storage.
     *
     * @param $chain
     * @internal param $id
     * @return Response
     */
    public function postDelete($chain)
    {
            // Was the chain deleted?
            if($chain->delete()) {
                // Redirect to the chain management page
                return Redirect::to('admin/chains')->with('success', Lang::get('admin/chains/messages.delete.success'));
            }

            // There was a problem deleting the chain
            return Redirect::to('admin/chains')->with('error', Lang::get('admin/chains/messages.delete.error'));
    }

    /**
     * Show a list of all the chains formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData()
    {
       $chains = Chain::select(array('chains.id',  'chains.chain_name', 'chains.url', 'chains.alternate_name', 'chains.updated_at'));

       return Datatables::of($chains)
        ->edit_column('updated_at','{{{ Carbon::now()->diffForHumans(Carbon::createFromTimestamp(strtotime($updated_at))) }}}')
        ->add_column('actions', '<a href="{{{ URL::to(\'admin/chains/\' . $id . \'/edit\' ) }}}" class="btn btn-xs btn-default">{{{ Lang::get(\'button.edit\') }}}</a>
                <a href="{{{ URL::to(\'admin/chains/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger">{{{ Lang::get(\'button.delete\') }}}</a>
        ')
        ->remove_column('id')
        ->remove_column('created_at')
        ->make();
    }

}
