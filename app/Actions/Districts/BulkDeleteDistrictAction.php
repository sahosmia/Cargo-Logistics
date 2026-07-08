<?php

namespace App\Actions\Districts;

use App\Models\District;

class BulkDeleteDistrictAction
{
    public function execute(array $ids): int
    {
        return District::whereIn('id', $ids)->delete();
    }
}
