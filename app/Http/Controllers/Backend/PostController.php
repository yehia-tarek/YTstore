<?php

namespace App\Http\Controllers\Backend;

use SplStack;
use App\Models\Post;
use App\Models\User;
use App\Models\PostTag;
use App\Models\PostCategory;
use App\Http\Requests\PostRequest;
use App\Services\Post\IPostService;
use App\Services\User\IUserService;
use App\Http\Controllers\Controller;
use App\Services\PostTag\IPostTagService;
use App\Services\PostCategory\IPostCategoryService;

class PostController extends Controller
{

    protected $postService;
    protected $postCategoryService;
    protected $postTagService;
    protected $userService;

    public function __construct(
        IPostService $postService,
        IPostCategoryService $postCategoryService,
        IPostTagService $postTagService,
        IUserService $userService
    ) {
        $this->postService = $postService;
        $this->postCategoryService = $postCategoryService;
        $this->postTagService = $postTagService;
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $posts = $this->postService->getAllPost(true, 10);

        return view('backend.post.index', [
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $categories = $this->postCategoryService->getAllPostCategories();
        $tags = $this->postTagService->getAllPostTag();
        $users = $this->userService->getAllUsers();

        return view('backend.post.create', [
            'users' => $users,
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $status =  $this->postService->store($request->validated());

        if ($status) {
            request()->session()->flash('success', 'Post Successfully added');
        } else {
            request()->session()->flash('error', 'Please try again!!');
        }

        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $post = $this->postService->getPostById($id);
        $categories = $this->postCategoryService->getAllPostCategories();
        $tags = $this->postTagService->getAllPostTag();
        $users = $this->userService->getAllUsers();

        return view('backend.post.edit', [
            'users' => $users,
            'categories' => $categories,
            'tags' => $tags,
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(PostRequest $request, $id)
    {
        $status = $this->postService->update($request->validated(), $id);

        if ($status) {
            request()->session()->flash('success', 'Post Successfully updated');
        } else {
            request()->session()->flash('error', 'No update done');
        }

        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = $this->postService->destroy($id);

        if ($status) {
            request()->session()->flash('success', 'Post successfully deleted');
        } else {
            request()->session()->flash('error', 'Error while deleting post ');
        }

        return redirect()->route('post.index');
    }
}
