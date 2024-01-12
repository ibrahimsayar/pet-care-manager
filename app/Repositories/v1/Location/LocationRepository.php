<?php

namespace App\Repositories\v1\Location;

use App\Interfaces\v1\Location\LocationRepositoryInterface;
use App\Models\City;
use App\Models\District;
use Illuminate\Database\Eloquent\Collection;

class LocationRepository implements LocationRepositoryInterface
{
    /**
     * @return Collection
     */
    public function cities(): Collection
    {
        return City::all();
    }

    /***
     * @return Collection
     */
    public function districts(): Collection
    {
        return District::all();
    }
}
