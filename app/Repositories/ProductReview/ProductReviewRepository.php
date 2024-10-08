<?php

namespace App\Repositories\ProductReview;

use Illuminate\Support\Facades\DB;

class ProductReviewRepository implements IProductReviewRepository
{

    public function getReviewById($id)
    {
        return DB::table('product_reviews')
            ->where('product_reviews.id', $id)
            ->join('products', 'product_reviews.product_id', '=', 'products.id')
            ->select('product_reviews.*', 'products.title as product_name')
            ->first();
    }

    public function getAllReviewByUser($userId, $paginate = false, $perPage = 10)
    {
        $query = DB::table('product_reviews')
            ->where('user_id', $userId)
            ->join('products', 'product_reviews.product_id', '=', 'products.id')
            ->select('product_reviews.*', 'products.title as product_name');

        if ($paginate) {
            return $query->paginate($perPage);
        }

        return $query->get();
    }

    public function getAllReviewByProductId($productId, $paginate = false, $perPage = 10)
    {
        $query = DB::table('product_reviews')
            ->where('product_id', $productId)
            ->join('users', 'product_reviews.user_id', '=', 'users.id')
            ->select('product_reviews.*', 'users.name as user_name', 'users.photo as user_photo');

        if ($paginate) {
            return $query->paginate($perPage);
        }

        return $query->get();
    }

    public function update($id, $data)
    {
        return DB::table('product_reviews')
            ->where('id', $id)
            ->update($data);
    }

    public function delete($id)
    {
        return DB::table('product_reviews')
            ->where('id', $id)
            ->delete();
    }
}
