<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ListService
{
    public function getList(): Collection
    {
        return DB::table('basic_data')->get();
    }
}