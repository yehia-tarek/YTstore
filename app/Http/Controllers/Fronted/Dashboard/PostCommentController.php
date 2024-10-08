<?php

namespace App\Http\Controllers\Fronted\Dashboard;


use App\Http\Controllers\Controller;
use App\Services\PostComment\IPostCommentService;
use App\Http\Requests\Fronted\Dashboard\PostCommentRequest;

class PostCommentController extends Controller
{

    protected $postCommentService;

    public function __construct(IPostCommentService $postCommentService)
    {
        $this->postCommentService = $postCommentService;
    }

    public function index()
    {
        $comments = $this->postCommentService->getAllPostCommentByUser(auth()->user()->id, true);

        return view('user.comment.index', [
            'comments' => $comments,
            'user' => auth()->user()
        ]);
    }



    public function edit($id)
    {
        $comments = $this->postCommentService->getPostCommentById($id);

        if (!$comments) {
            request()->session()->flash('error', 'Comment not found');
            return redirect()->back();
        }

        return view('user.comment.edit', [
            'comment' => $comments,
            'user' => auth()->user()
        ]);
    }

    public function update(PostCommentRequest $request, $id)
    {
        $status = $this->postCommentService->update($id, $request->validated());

        if ($status) {
            request()->session()->flash('success', 'Comment successfully updated');
        } else {
            request()->session()->flash('error', 'No Update Has Been Made');
        }

        return redirect()->route('user.post-comment.index');
    }

    public function delete($id)
    {
        $status = $this->postCommentService->delete($id);

        if ($status) {
            request()->session()->flash('success', 'Post Comment successfully deleted');
        } else {
            request()->session()->flash('error', 'Error occurred please try again');
        }

        return back();
    }
}
