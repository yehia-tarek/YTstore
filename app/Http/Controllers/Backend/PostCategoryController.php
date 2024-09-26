<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use App\Http\Requests\PostCategoryRequest;

class PostCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $postCategory = PostCategory::orderBy('id', 'DESC')->paginate(10);

        return view('backend.postcategory.index', [
            'postCategories' => $postCategory
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
        $data = $request->all();

        $data['slug'] = generateSlug($request->title, 'post_categories');

        $postCategory = PostCategory::create($data);

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
        $postCategory = PostCategory::findOrFail($id);
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
        $postCategory = PostCategory::findOrFail($id);

        $data = $request->all();

        if($request->title != $postCategory->title){
            $data['slug'] = generateSlug($request->title, 'post_categories');
        }

        $updatedPostCategory = $postCategory->fill($data)->save();

        if ($updatedPostCategory) {
            request()->session()->flash('success', 'Post Category Successfully updated');
        } else {
            request()->session()->flash('error', 'Please try again!!');
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
        $postCategory = PostCategory::findOrFail($id);

        $status = $postCategory->delete();

        if ($status) {
            request()->session()->flash('success', 'Post Category successfully deleted');
        } else {
            request()->session()->flash('error', 'Error while deleting post category');
        }

        return redirect()->route('post-category.index');
    }
}
