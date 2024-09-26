<?php

namespace App\Http\Controllers\Fronted\Dashboard;


use App\Http\Controllers\Controller;
use App\Services\ProductReview\IProductReviewService;
use App\Http\Requests\Fronted\Dashboard\ProductReviewRequest;

class ProductReviewController extends Controller
{
    private $productReviewService;

    public function __construct(IProductReviewService $productReviewService)
    {
        $this->productReviewService = $productReviewService;
    }

    public function index()
    {
        $user = auth()->user();

        $reviews = $this->productReviewService->getAllReviewByUser($user->id, true, 10);

        return view('user.review.index', [
            'reviews' => $reviews,
            'user' => $user
        ]);
    }


    public function edit($id)
    {
        $review = $this->productReviewService->getReviewById($id);

        return view('user.review.edit', [
            'review' => $review,
            'user' => auth()->user()
        ]);
    }

    public function update(ProductReviewRequest $request, $id)
    {
        $status = $this->productReviewService->update($id, $request->validated());

        if ($status) {
            request()->session()->flash('success', 'Review Successfully updated');
        } else {
            request()->session()->flash('error', 'Something went wrong! Please try again!!');
        }

        return redirect()->route('user.productreview.index');
    }

    public function delete($id)
    {
        $status = $this->productReviewService->delete($id);

        if ($status) {
            request()->session()->flash('success', 'Successfully deleted review');
        } else {
            request()->session()->flash('error', 'Something went wrong! Try again');
        }

        return redirect()->route('user.productreview.index');
    }
}
