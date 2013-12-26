<?php

class AdminProductsController extends AdminController {


    /**
     * Post Model
     * @var Post
     */
    protected $products;

    /**
     * Inject the models.
     * @param Post $product
     */
    public function __construct(Product $product)
    {
        parent::__construct();
        $this->post = $product;
    }

    /**
     * Show a list of all the blog posts.
     *
     * @return View
     */
    public function getIndex()
    {
        // Title
        $title = Lang::get('admin/products/title.blog_management');

        // Grab all the products
        $product = $this->product;

        // Show the page
        return View::make('admin/product/index', compact('products', 'title'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function getCreate()
    {
        // Title
        $title = Lang::get('admin/products/title.create_a_new_product');

        // Show the page
        return View::make('admin/products/create_edit', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function productCreate()
    {
        // Declare the rules for the form validation
        $rules = array(
            'title'   => 'required|min:3',
            'content' => 'required|min:3'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            // Create a new product
            $user = Auth::user();

            // Update the product data
            $this->product->title            = Input::get('title');
            $this->product->slug             = Str::slug(Input::get('title'));
            $this->product->content          = Input::get('content');
            $this->post->meta_title       = Input::get('meta-title');
            $this->post->meta_description = Input::get('meta-description');
            $this->post->meta_keywords    = Input::get('meta-keywords');
            $this->post->user_id          = $user->id;

            // Was the blog post created?
            if($this->post->save())
            {
                // Redirect to the new blog post page
                return Redirect::to('admin/products/' . $this->post->id . '/edit')->with('success', Lang::get('admin/products/messages.create.success'));
            }

            // Redirect to the blog post create page
            return Redirect::to('admin/products/create')->with('error', Lang::get('admin/products/messages.create.error'));
        }

        // Form validation failed
        return Redirect::to('admin/products/create')->withInput()->withErrors($validator);
	}

    /**
     * Display the specified resource.
     *
     * @param $product
     * @return Response
     */
	public function getShow($product)
	{
        // redirect to the frontend
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param $product
     * @return Response
     */
    public function getEdit($product)
    {
        // Title
        $title = Lang::get('admin/products/title.blog_update');

        // Show the page
        return View::make('admin/products/create_edit', compact('post', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $product
     * @return Response
     */
    public function productEdit($product)
    {

        // Declare the rules for the form validation
        $rules = array(
            'title'   => 'required|min:3',
            'content' => 'required|min:3'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            // Update the blog post data
            $product->title            = Input::get('title');
            $product->slug             = Str::slug(Input::get('title'));
            $product->content          = Input::get('content');
            $product->meta_title       = Input::get('meta-title');
            $product->meta_description = Input::get('meta-description');
            $product->meta_keywords    = Input::get('meta-keywords');

            // Was the blog post updated?
            if($product->save())
            {
                // Redirect to the new blog post page
                return Redirect::to('admin/products/' . $product->id . '/edit')->with('success', Lang::get('admin/products/messages.update.success'));
            }

            // Redirect to the products post management page
            return Redirect::to('admin/products/' . $product->id . '/edit')->with('error', Lang::get('admin/products/messages.update.error'));
        }

        // Form validation failed
        return Redirect::to('admin/products/' . $product->id . '/edit')->withInput()->withErrors($validator);
	}


    /**
     * Remove the specified resource from storage.
     *
     * @param $product
     * @return Response
     */
    public function getDelete($product)
    {
        // Title
        $title = Lang::get('admin/products/title.blog_delete');

        // Show the page
        return View::make('admin/products/delete', compact('post', 'title'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $product
     * @return Response
     */
    public function postDelete($product)
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
            $id = $product->id;
            $product->delete();

            // Was the blog post deleted?
            $product = Post::find($id);
            if(empty($product))
            {
                // Redirect to the blog posts management page
                return Redirect::to('admin/products')->with('success', Lang::get('admin/products/messages.delete.success'));
            }
        }
        // There was a problem deleting the blog post
        return Redirect::to('admin/products')->with('error', Lang::get('admin/products/messages.delete.error'));
    }

    /**
     * Show a list of all the blog posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData()
    {
        $products = Post::select(array('posts.id', 'posts.title', 'posts.id as comments', 'posts.created_at'));

        return Datatables::of($products)

        ->edit_column('comments', '{{ DB::table(\'comments\')->where(\'post_id\', \'=\', $id)->count() }}')

        ->add_column('actions', '<a href="{{{ URL::to(\'admin/products/\' . $id . \'/edit\' ) }}}" class="btn btn-default btn-xs iframe" >{{{ Lang::get(\'button.edit\') }}}</a>
                <a href="{{{ URL::to(\'admin/products/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger iframe">{{{ Lang::get(\'button.delete\') }}}</a>
            ')

        ->remove_column('id')

        ->make();
    }

}
