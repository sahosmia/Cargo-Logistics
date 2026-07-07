<?php

namespace App\Actions\Districts;

use App\Models\District;

class UpdateDistrictAction
{
    public function execute(District $district, array $data): bool
    {
        return $district->update($data);
    }
}
