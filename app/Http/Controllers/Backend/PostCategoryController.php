<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostCategoryRequest;
use App\Services\PostCategory\IPostCategoryService;

class PostCategoryController extends Controller
{
    protected $postCategoryService;

    public function __construct(IPostCategoryService $postCategoryService)
    {
        $this->postCategoryService = $postCategoryService;
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $postCategories = $this->postCategoryService->getAllPostCategories(true, 10, 'id', 'DESC');

        return view('backend.postcategory.index', [
            'postCategories' => $postCategories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('backend.postcategory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostCategoryRequest $request)
    {
        $postCategory = $this->postCategoryService->store($request->validated());

        if ($postCategory) {
            request()->session()->flash('success', 'Post Category Successfully added');
        } else {
            request()->session()->flash('error', 'Please try again!!');
        }

        return redirect()->route('post-category.index');
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
        $postCategory = $this->postCategoryService->getPostCategoryById($id);

        return view('backend.postcategory.edit',[
            'postCategory' => $postCategory
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostCategoryRequest $request, $id)
    {
        $status = $this->postCategoryService->update($request->validated(), $id);

        if ($status) {
            request()->session()->flash('success', 'Post Category Successfully updated');
        } else {
            request()->session()->flash('error', 'No update done');
        }

        return redirect()->route('post-category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = $this->postCategoryService->destroy($id);

        if ($status) {
            request()->session()->flash('success', 'Post Category successfully deleted');
        } else {
            request()->session()->flash('error', 'Error while deleting post category');
        }

        return redirect()->route('post-category.index');
    }
}
