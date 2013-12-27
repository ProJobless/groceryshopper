<?php

class HomeController extends BaseController {
        
    /**
     * User Model
     * @var User
     */
    protected $user;

    public function __construct(User $user)
    {
        parent::__construct();

        $this->user = $user;
    }
    /**
     * Returns all the blog posts.
     *
     * @return View
     */
    public function getIndex()
    {
        // Show the page
        return View::make('site/index', compact('posts'));
    }
}
