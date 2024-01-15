<?php

namespace App\Http\Controllers\v1\Auth;

use App\Helpers\Location;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Auth\RegisterRequest;
use App\Interfaces\v1\Auth\AuthRepositoryInterface;
use App\Services\ResponseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use MaxMind\Db\Reader\InvalidDatabaseException;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    /**
     * @var AuthRepositoryInterface
     */
    private AuthRepositoryInterface $authRepository;

    /**
     * @var ResponseService
     */
    private ResponseService $return;

    /**
     * @param  AuthRepositoryInterface  $authRepository
     * @param  ResponseService  $return
     */
    public function __construct(
        AuthRepositoryInterface $authRepository,
        ResponseService $return,

    ) {
        $this->authRepository = $authRepository;
        $this->return = $return;
    }

    /**
     * @param  RegisterRequest  $request
     * @return JsonResponse
     * @throws InvalidDatabaseException
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $user = $request->validated();

        $ip = $request->ip();

        $location = new Location();
        $user['iso_code'] = $location->isoCode($ip);
        $user['country_name'] = $location->countryName($ip);

        $user['password'] = Hash::make($user['password']);

        $id = $this
            ->authRepository
            ->register($user);

        if ($id) {
            $user = $this
                ->authRepository
                ->get($id);

            return $this->return
                ->message('SUCCESS')
                ->data($user)
                ->status(Response::HTTP_CREATED)
                ->response();
        }

        return $this->return
            ->message('FAILED')
            ->data([])
            ->status(Response::HTTP_BAD_REQUEST)
            ->response();
    }
}
