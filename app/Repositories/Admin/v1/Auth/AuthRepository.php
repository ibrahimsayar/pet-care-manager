<?php

namespace App\Repositories\Admin\v1\Auth;

use App\Interfaces\Admin\v1\Auth\AuthRepositoryInterface;
use App\Models\Admin;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class AuthRepository implements AuthRepositoryInterface
{
    /**
     * @param  int  $id
     * @return Collection|Model
     */
    public function get(int $id): Collection|Model
    {
        return Admin::query()->find($id);
    }
}
