<?php

namespace App\Actions\Districts;

use App\Models\District;

class StoreDistrictAction
{
    public function execute(array $data): District
    {
        return District::create($data);
    }
}
