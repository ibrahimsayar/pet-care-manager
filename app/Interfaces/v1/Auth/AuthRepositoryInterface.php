<?php

namespace App\Interfaces\v1\Auth;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface AuthRepositoryInterface
{
    /**
     * @param  array  $user
     * @return int
     */
    public function register(array $user): int;

    /**
     * @param  int  $id
     * @return Collection|Model
     */
    public function get(int $id): Collection|Model;
}
