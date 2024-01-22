<?php

namespace App\Http\Controllers\Admin\v1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\v1\Auth\AuthenticationRequest;
use App\Interfaces\Admin\v1\Auth\AuthRepositoryInterface;
use App\Services\ResponseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
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
    private ResponseService $responseService;

    /**
     * @param  AuthRepositoryInterface  $authRepository
     * @param  ResponseService  $responseService
     */
    public function __construct(
        AuthRepositoryInterface $authRepository,
        ResponseService $responseService,
    ) {
        $this->authRepository = $authRepository;
        $this->responseService = $responseService;
    }

    /**
     * @param  AuthenticationRequest  $request
     * @return JsonResponse
     */
    public function authentication(AuthenticationRequest $request): JsonResponse
    {
        $credentials = $request->validated();
        $token = auth('admin')->attempt($credentials);

        if (!$token) {
            return $this->responseService
                ->message('INVALID_CREDENTIALS')
                ->statusCode(Response::HTTP_BAD_REQUEST)
                ->status(false)
                ->response();
        };

        $admin = $this->authRepository->get(Auth::guard('admin')->id());

        return $this->responseService
            ->data([
                ...$admin->toArray(),
                'token' => $token,
            ])
            ->response();
    }
}
