<?php

namespace App\Interfaces\v1\Location;

use Illuminate\Database\Eloquent\Collection;

interface LocationRepositoryInterface
{
    /**
     * @return Collection
     */
    public function cities(): Collection;

    /**
     * @return Collection
     */
    public function districts(): Collection;
}
