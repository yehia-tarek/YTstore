<?php

namespace App\Http\Controllers\Backend;

use SplStack;
use App\Models\Post;
use App\Models\User;
use App\Models\PostTag;
use App\Models\PostCategory;
use App\Http\Requests\PostRequest;
use App\Services\Post\IPostService;
use App\Http\Controllers\Controller;
use App\Services\PostTag\IPostTagService;
use App\Services\PostCategory\IPostCategoryService;

class PostController extends Controller
{

    protected $postService;
    protected $postCategoryService;
    protected $postTagService;

    public function __construct(
        IPostService $postService,
        IPostCategoryService $postCategoryService,
        IPostTagService $postTagService
    ) {
        $this->postService = $postService;
        $this->postCategoryService = $postCategoryService;
        $this->postTagService = $postTagService;

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
        // $tags = PostTag::all();
        $users = User::all();

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
        $data = $request->all();

        $data['slug'] = generateSlug($request->title, 'posts');

        $tags = $request->input('tags');

        if ($tags) {
            $data['tags'] = implode(',', $tags);
        } else {
            $data['tags'] = '';
        }

        $post = Post::create($data);

        if ($post) {
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
        $post = Post::findOrFail($id);
        $categories = PostCategory::all();
        $tags = PostTag::all();
        $users = User::all();

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
        $post = Post::findOrFail($id);

        $data = $request->all();

        if ($request->title != $post->title) {
            $data['slug'] = generateSlug($request->title, 'posts');
        }

        $tags = $request->input('tags');
        if ($tags) {
            $data['tags'] = implode(',', $tags);
        } else {
            $data['tags'] = '';
        }

        $updatedPost = $post->fill($data)->save();

        if ($updatedPost) {
            request()->session()->flash('success', 'Post Successfully updated');
        } else {
            request()->session()->flash('error', 'Please try again!!');
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
        $post = Post::findOrFail($id);

        $status = $post->delete();

        if ($status) {
            request()->session()->flash('success', 'Post successfully deleted');
        } else {
            request()->session()->flash('error', 'Error while deleting post ');
        }

        return redirect()->route('post.index');
    }
}
