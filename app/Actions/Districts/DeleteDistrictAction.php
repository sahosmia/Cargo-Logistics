<?php

namespace App\Actions\Districts;

use App\Models\District;

class DeleteDistrictAction
{
    public function execute(District $district): ?bool
    {
        return $district->delete();
    }
}
