<?php

class AdminPermissionsController extends AdminController {
    /**
     * User Model
     * @var User
     */
    protected $user;

    /**
     * Role Model
     * @var Role
     */
    protected $role;

    /**
     * Permission Model
     * @var Permission
     */
    protected $permission;

    /**
     * Inject the models.
     * @param User $user
     * @param Role $role
     * @param Permission $permission
     */
    public function __construct(User $user, Role $role, Permission $permission)
    {
        parent::__construct();
        $this->user = $user;
        $this->role = $role;
        $this->permission = $permission;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {
        // Title
        $title = Lang::get('admin/permissions/title.permissions_management');

        // Grab all the groups
        $roles = $this->permission;

        // Show the page
        return View::make('admin/permissions/index', compact('permissions', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate()
    {
        // Get all the available roles
        $roles = $this->role->all();

        // Selected permissions
        $selectedPermissions = Input::old('permissions', array());

        // Title
        $title = Lang::get('admin/permissions/title.create_a_new_permission');

        // Show the page
        return View::make('admin/permissions/create', compact('roles', 'selectedPermissions', 'title'));
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
            'name' => 'required',
            'display_name' => 'required'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);
        // Check if the form validates with success
        if ($validator->passes())
        {
            // Get the inputs, with some exceptions
            $inputs = Input::except('csrf_token');

            $this->permission->name = $inputs['name'];
            $this->permission->display_name = $inputs['display_name'];
            $this->permission->save();


            // Was the permisison created?
            if ($this->permission->id)
            {
                // Redirect to the permissions page
                return Redirect::to('admin/permissions')->with('success', Lang::get('admin/permissions/messages.create.success'));
            }

            // Redirect to the new permissions page
            return Redirect::to('admin/permissions/create')->with('error', Lang::get('admin/permissions/messages.create.error'));

            // Redirect to the permisisons create page
            //return Redirect::to('admin/permissions/create')->withInput()->with('error', Lang::get('admin/permissions/messages.' . $error));
        }

        // Form validation failed
        return Redirect::to('admin/permissions/create')->withInput()->withErrors($validator);
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
     * @param $role
     * @return Response
     */
    public function getEdit($permission)
    {
        if(empty($permission))
        {
            // Redirect to the permissions management page
            return Redirect::to('admin/permissions')->with('error', Lang::get('admin/permissions/messages.does_not_exist'));
        }

        // Title
        $title = Lang::get('admin/permissions/title.permission_update');

        // Show the page
        return View::make('admin/permissions/edit', compact('permission','title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $role
     * @return Response
     */
    public function postEdit($permission)
    {
        // Declare the rules for the form validation
        $rules = array(
            'name' => 'required',
            'display_name' => 'required'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            // Update the role data
            $permission->name        	= Input::get('name');
            $permission->display_name   = Input::get('display_name');

            // Was the permission updated?
            if ($permission->save())
            {
                return Redirect::to('admin/permissions/' . $permission->id . '/edit')->with('success', Lang::get('admin/permissions/messages.update.success'));
            }
            else
            {
                return Redirect::to('admin/permissions/' . $permission->id . '/edit')->with('error', Lang::get('admin/permissions/messages.update.error'));
            }
        }

        // Form validation failed
        return Redirect::to('admin/permissions/' . $permission->id . '/edit')->withInput()->withErrors($validator);
    }


    /**
     * Remove user page.
     *
     * @param $role
     * @return Response
     */
    public function getDelete($permission)
    {
        // Title
        $title = Lang::get('admin/permissions/title.permission_delete');

        // Show the page
        return View::make('admin/permissions/delete', compact('permission', 'title'));
    }

    /**
     * Remove the specified permission from storage.
     *
     * @param $role
     * @internal param $id
     * @return Response
     */
    public function postDelete($permission)
    {
            // Was the role deleted?
            if($permission->delete()) {
                // Redirect to the role management page
                return Redirect::to('admin/permissions')->with('success', Lang::get('admin/permissions/messages.delete.success'));
            }

            // There was a problem deleting the role
            return Redirect::to('admin/permissions')->with('error', Lang::get('admin/permissions/messages.delete.error'));
    }

    /**
     * Show a list of all the roles formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData()
    {
        $permissions = Permission::select(array('permissions.id',  'permissions.display_name', 'permissions.id as roles', 'permissions.name'));

        return Datatables::of($permissions)
        //->edit_column('created_at','{{{ Carbon::now()->diffForHumans(Carbon::createFromFormat(\'Y-m-d H\', $test)) }}}')
        ->edit_column('roles', '{{{ DB::table(\'permission_role\')->where(\'permission_id\', \'=\', $id)->count()  }}}')
        ->add_column('actions', '<a href="{{{ URL::to(\'admin/permissions/\' . $id . \'/edit\' ) }}}" class="btn btn-xs btn-default">{{{ Lang::get(\'button.edit\') }}}</a>
                                <a href="{{{ URL::to(\'admin/permissions/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger">{{{ Lang::get(\'button.delete\') }}}</a>
                    ')
        ->remove_column('id')
        ->make();
    }
}


