<?php

namespace App\Repositories\v1\Auth;

use App\Interfaces\v1\Auth\AuthRepositoryInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class AuthRepository implements AuthRepositoryInterface
{

    /**
     * @param  array  $user
     * @return int
     */
    public function register(array $user): int
    {
        return User::query()->insertGetId($user);
    }

    /**
     * @param  int  $id
     * @return Collection|Model
     */
    public function get(int $id): Collection|Model
    {
        return User::query()->find($id);
    }
}
