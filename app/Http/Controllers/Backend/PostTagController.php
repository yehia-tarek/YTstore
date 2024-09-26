<?php

namespace App\Http\Controllers\Backend;


use App\Http\Controllers\Controller;
use App\Models\PostTag;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\PostTagRequest;

class PostTagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $postTag = PostTag::orderBy('id', 'DESC')->paginate(10);

        return view('backend.posttag.index', [
            'postTags' => $postTag
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('backend.posttag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostTagRequest $request)
    {
        $data = $request->all();

        $data['slug'] = generateSlug($request->title, 'post_tags');

        $postTag = PostTag::create($data);

        if ($postTag) {
            request()->session()->flash('success', 'Post Tag Successfully added');
        } else {
            request()->session()->flash('error', 'Please try again!!');
        }

        return redirect()->route('post-tag.index');
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
        $postTag = PostTag::findOrFail($id);

        return view('backend.posttag.edit',[
            'postTag' => $postTag
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostTagRequest $request, $id)
    {
        $postTag = PostTag::findOrFail($id);

        $data = $request->all();

        if($request->title != $postTag->title){
            $data['slug'] = generateSlug($request->title, 'post_tags');
        }

        $updatedPostTag = $postTag->fill($data)->save();

        if ($updatedPostTag) {
            request()->session()->flash('success', 'Post Tag Successfully updated');
        } else {
            request()->session()->flash('error', 'Please try again!!');
        }

        return redirect()->route('post-tag.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $postTag = PostTag::findOrFail($id);

        $status = $postTag->delete();

        if ($status) {
            request()->session()->flash('success', 'Post Tag successfully deleted');
        } else {
            request()->session()->flash('error', 'Error while deleting post tag');
        }

        return redirect()->route('post-tag.index');
    }
}
