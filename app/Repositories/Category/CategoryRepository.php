<?php

namespace App\Repositories\Category;

use Illuminate\Support\Facades\DB;

class CategoryRepository implements ICategoryRepository
{
    public function getParentCategories($categoryId, $orderBy = 'id', $order = 'DESC')
    {
        return DB::table('categories')
            ->where('is_parent', 1)
            ->where('id', '!=', $categoryId)
            ->orderBy($orderBy, $order)
            ->get();
    }

    public function getAllCategoriesWithParent($paginate = true, $perPage = 10, $orderBy = 'id', $order = 'DESC', $parentCoulmns = ['parent.title as parent_title'])
    {
        $query = DB::table('categories')
            ->leftJoin('categories as parent', 'categories.parent_id', 'parent.id')
            ->select('categories.*')
            ->addSelect($parentCoulmns)
            ->orderBy($orderBy, $order);

        if ($paginate) {
            return $query->paginate($perPage);
        }

        return $query->get();
    }

    public function getChildByParentId($id, $orderBy = 'id', $order = 'ASC')
    {
        return DB::table('categories')
            ->where('parent_id', $id)
            ->orderBy($orderBy, $order)
            ->pluck('title', 'id');
    }

    public function getCategoryById($id)
    {
        return DB::table('categories')->where('id', $id)->first();
    }

    public function store($data)
    {
        return DB::table('categories')->insert($data);
    }

    public function update($data, $id)
    {
        return DB::table('categories')->where('id', $id)->update($data);
    }

    public function destroy($id)
    {
        $this->shiftChildren($id);
        return DB::table('categories')->where('id', $id)->delete();
    }

    public function shiftChildren($id)
    {
        return DB::table('categories')->where('parent_id', $id)->update(['parent_id' => null, 'is_parent' => 1]);
    }
}
