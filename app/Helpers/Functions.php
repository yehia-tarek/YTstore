<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

function generateSlug(string $title, string $tableName) : string
{
    $slug = Str::slug($title);
    $count = DB::table($tableName)->where('slug', $slug)->count();
    if ($count > 0) {
        $slug = $slug . '-' . date('ymdis') . '-' . rand(0, 999);
    }
    return $slug;
}
