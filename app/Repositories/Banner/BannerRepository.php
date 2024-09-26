<?php

namespace App\Repositories\Banner;

use Illuminate\Support\Facades\DB;


class BannerRepository implements IBannerRepository
{

    public function getAllBanners($paginate = false, $perPage = 10, $orderBy = 'id', $order = 'DESC')
    {
        $query = DB::table('banners')
            ->orderBy($orderBy, $order);

        if ($paginate == true) {
            return $query->paginate($perPage);
        }

        return $query->get();
    }

    public function getBannerById($id)
    {
        return DB::table('banners')
            ->where('id', $id)
            ->first();
    }

    public function store($data)
    {
        return DB::table('banners')
            ->insert($data);
    }

    public function update($data, $id)
    {
        return DB::table('banners')
            ->where('id', $id)
            ->update($data);
    }

    public function destroy($id)
    {
        return DB::table('banners')
            ->where('id', $id)
            ->delete();
    }
}
