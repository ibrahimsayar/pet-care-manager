<?php

namespace App\Interfaces\Admin\v1\Auth;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface AuthRepositoryInterface
{
    /**
     * @param  int  $id
     * @return Collection|Model
     */
    public function get(int $id): Collection|Model;
}
