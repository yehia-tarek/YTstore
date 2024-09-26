<?php

namespace App\Services\ProductReview;

use App\Repositories\ProductReview\IProductReviewRepository;


class ProductReviewService implements IProductReviewService
{
    private $productReviewRepository;

    public function __construct(IProductReviewRepository $productReviewRepository)
    {
        $this->productReviewRepository = $productReviewRepository;
    }

    public function getReviewById($id)
    {
        return $this->productReviewRepository->getReviewById($id);
    }

    public function getAllReviewByUser($userId, $paginate = false, $perPage = 10)
    {
        return $this->productReviewRepository->getAllReviewByUser($userId, $paginate, $perPage);
    }

    public function update($id, $data)
    {
        return $this->productReviewRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->productReviewRepository->delete($id);
    }
}
