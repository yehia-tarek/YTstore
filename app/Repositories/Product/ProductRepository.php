<?php

namespace App\Repositories\Product;

use Illuminate\Support\Facades\DB;
use App\Repositories\Product\IProductRepository;

class ProductRepository implements IProductRepository
{
    public function getAllProduct()
    {
        return DB::table('products')
            ->leftJoin('categories as cat_info', 'products.cat_id', '=', 'cat_info.id') // Joining the main category
            ->leftJoin('categories as sub_cat_info', 'products.child_cat_id', '=', 'sub_cat_info.id') // Joining the sub-category
            ->leftJoin('brands', 'products.brand_id', '=', 'brands.id') // Joining the brand
            ->select(
                'products.*',
                'cat_info.title as category_name',       // Select category name (or any field you need)
                'sub_cat_info.title as sub_category_name', // Select sub-category name (or any field you need)
                'brands.title as brand_name'
            )
            ->orderBy('products.id', 'desc')
            ->paginate(10);
    }

    public function getProductsCountByCategoryId($id)
    {
        return DB::table('products')->where('cat_id', $id)->count();
    }

    public function getProductsByCategoryId($id)
    {
        return DB::table('products')->where('cat_id', $id)->get();
    }

    public function getProductById($id)
    {
        return DB::table('products')->where('id', $id)->first();
    }

    public function getProductBySlug($slug)
    {
        return DB::table('products')
            ->where('products.slug', $slug)
            ->first();
    }

    public function store($data)
    {
        return DB::table('products')->insert($data);
    }

    public function update($data, $id)
    {
        return DB::table('products')->where('id', $id)->update($data);
    }

    public function delete($id)
    {
        return DB::table('products')->where('id', $id)->delete();
    }
}
