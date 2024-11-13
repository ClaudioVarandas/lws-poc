<?php

namespace App\Modules\Server\Repository;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class OptionRepository
{
    public function getLocations(): Collection
    {
        $json = Storage::disk('db')->get('locations.json');

        return collect(json_decode($json, true));
    }
}
