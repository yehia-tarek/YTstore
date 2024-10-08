<?php

namespace  App\Services\ProductReview;


interface IProductReviewService
{
    public function getAllReviewByUser($userId, $paginate = false, $perPage = 10);
    public function getReviewById($id);
    public function getAllReviewByProductId($productId, $paginate = false, $perPage = 10);
    public function update($id, $data);
    public function delete($id);
}
