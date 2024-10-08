<?php

namespace App\Repositories\Brand;

use Illuminate\Support\Facades\DB;
use App\Repositories\Brand\IBrandRepository;

class BrandRepository implements IBrandRepository
{
    public function getAllBrands($paginate = false, $perPage = 10, $orderBy = 'id', $order = 'DESC')
    {
        $query = DB::table('brands')
            ->orderBy($orderBy, $order);

        if ($paginate) {
            return $query->paginate($perPage);
        }

        return $query->get();
    }

    public function getBrandById($id)
    {
        return DB::table('brands')->where('id', $id)->first();
    }

    public function store($data)
    {
        return DB::table('brands')->insert($data);
    }

    public function update($data, $id)
    {
        return DB::table('brands')->where('id', $id)->update($data);
    }

    public function destroy($id)
    {
        return DB::table('brands')->where('id', $id)->delete();
    }
}
