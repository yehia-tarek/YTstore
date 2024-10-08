<?php

namespace App\Http\Controllers\Backend;


use App\Models\PostTag;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostTagRequest;
use App\Services\PostTag\IPostTagService;

class PostTagController extends Controller
{
    protected $postTagService;

    public function __construct(IPostTagService $postTagService)
    {
        $this->postTagService = $postTagService;
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $postTags = $this->postTagService->getAllPostTag(true, 10, 'id', 'desc');

        return view('backend.posttag.index', [
            'postTags' => $postTags
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
        $status = $this->postTagService->store($request->validated());

        if ($status) {
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
        $postTag = $this->postTagService->getPostTagById($id);

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
        $status = $this->postTagService->update($request->validated(), $id);

        if ($status) {
            request()->session()->flash('success', 'Post Tag Successfully updated');
        } else {
            request()->session()->flash('error', 'No update done');
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
        $status = $this->postTagService->delete($id);
    
        if ($status) {
            request()->session()->flash('success', 'Post Tag successfully deleted');
        } else {
            request()->session()->flash('error', 'Error while deleting post tag');
        }

        return redirect()->route('post-tag.index');
    }
}
