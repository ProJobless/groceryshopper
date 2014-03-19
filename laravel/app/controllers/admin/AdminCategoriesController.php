<?php

class AdminCategoriesController extends AdminController {

  /**
   * User Model
   * @var User
   */
  protected $user;

  /**
   * Role Model
   * @var Role
   */
  protected $category;

  /**
   * Permission Model
   * @var Permission
   */
  protected $permission;

  /**
   * Inject the models.
   * @param User $user
   * @param Category $category
   */
  public function __construct(User $user, Category $category)
  {
      parent::__construct();
      $this->user = $user;
      $this->category = $category;
  }

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function getIndex()
  {
      // Title
      $title = Lang::get('admin/categories/title.category_management');

      // Grab all the groups
      $categories = $this->category;

      // Show the page
      return View::make('admin/categories/index', compact('categories', 'title'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function getCreate()
  {

    // Title
    $title = Lang::get('admin/categories/title.create_a_new_category');

    // Mode
    $mode = 'create';
    // Show the page
    return View::make('admin/categories/create_edit', compact('title', 'mode'));
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
          'rank' => 'required'
      );

      // Validate the inputs
      $validator = Validator::make(Input::all(), $rules);
      // Check if the form validates with success
      if ($validator->passes())
      {
          // Get the inputs, with some exceptions
          $inputs = Input::except('csrf_token');

          $this->category->title = $inputs['title'];
          $this->category->slug  = Str::slug(Input::get('title'));
          $this->category->meta_title = $inputs['meta_title'];
          $this->category->rank = $inputs['rank'];
          $this->category->save();


          // Was the role created?
          if ($this->category->id)
          {
              // Redirect to the new category page
              return Redirect::to('admin/categories/' . $this->category->id . '/edit')->with('success', Lang::get('admin/categories/messages.create.success'));
          }

          // Redirect to the new category page
          return Redirect::to('admin/categories/create')->with('error', Lang::get('admin/categories/messages.create.error'));

          // Redirect to the  category create page
          return Redirect::to('admin/categories/create')->withInput()->with('error', Lang::get('admin/categories/messages.' . $error));
      }

      // Form validation failed
      return Redirect::to('admin/categories/create')->withInput()->withErrors($validator);
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
   * @param $category
   * @return Response
   */
  public function getEdit($category)
  {
    // Title
    $title = Lang::get('admin/categories/title.category_update');
    // Mode
    $mode = 'edit';
    // Show the page
    return View::make('admin/categories/create_edit', compact('category', 'mode', 'title'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param $category
   * @return Response
   */
  public function postEdit($category)
  {
      // Declare the rules for the form validation
      $rules = array(
          'title' => 'required',
          'rank' => 'required'
      );

      // Validate the inputs
      $validator = Validator::make(Input::all(), $rules);

      // Check if the form validates with success
      if ($validator->passes())
      {
          // Get the inputs, with some exceptions
          $inputs = Input::except('csrf_token');

          $category->title = $inputs['title'];
          $category->slug  = Str::slug(Input::get('title'));
          $category->meta_title = $inputs['meta_title'];
          $category->rank = $inputs['rank'];

          // Was the role updated?
          if ($category->save())
          {
            // Redirect to the category management page
            return Redirect::to('admin/categories')->with('success', Lang::get('admin/categories/messages.update.success'));
          }
          else
          {
              // Redirect to the role page
              return Redirect::to('admin/categories/' . $category->id . '/edit')->with('error', Lang::get('admin/categories/messages.update.error'));
          }
      }

      // Form validation failed
      return Redirect::to('admin/categories/' . $category->id . '/edit')->withInput()->withErrors($validator);
  }


  /**
   * Remove user page.
   *
   * @param $category
   * @return Response
   */
  public function getDelete($category)
  {
      // Title
      $title = Lang::get('admin/categories/title.role_delete');

      // Show the page
      return View::make('admin/categories/delete', compact('category', 'title'));
  }

  /**
   * Remove the specified user from storage.
   *
   * @param $category
   * @internal param $id
   * @return Response
   */
  public function postDelete($category)
  {
    // Was the role deleted?
    if($category->delete()) {
        // Redirect to the role management page
        return Redirect::to('admin/categories')->with('success', Lang::get('admin/categories/messages.delete.success'));
    }

    // There was a problem deleting the role
    return Redirect::to('admin/categories')->with('error', Lang::get('admin/categories/messages.delete.error'));
  }

  /**
   * Show a list of all the categories formatted for Datatables.
   *
   * @return Datatables JSON
   */
  public function getData()
  {
      $categories = Category::select(array('categories.id',  'categories.title', 'categories.slug', 'categories.meta_title', 'categories.rank', 'categories.updated_at'));

      return Datatables::of($categories)
        ->edit_column('updated_at','{{{ Carbon::now()->diffForHumans(Carbon::createFromTimestamp(strtotime($updated_at))) }}}')
        ->add_column('actions', '<a href="{{{ URL::to(\'admin/categories/\' . $id . \'/edit\' ) }}}" class="btn btn-xs btn-default">{{{ Lang::get(\'button.edit\') }}}</a>
                <a href="{{{ URL::to(\'admin/categories/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger">{{{ Lang::get(\'button.delete\') }}}</a>
        ')
        ->remove_column('id')
        ->make();
  }

}