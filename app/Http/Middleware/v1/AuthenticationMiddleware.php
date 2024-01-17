<?php

namespace App\Http\Middleware\v1;

use App\Services\ResponseService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthenticationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $return = new ResponseService();

        try {
            JWTAuth::parseToken()->toUser();
        } catch (TokenInvalidException) {
            return $return->status(false)
                ->statusCode(Response::HTTP_UNAUTHORIZED)
                ->message('INVALID_AUTHORIZATION_TOKEN')
                ->response();
        } catch (TokenExpiredException) {
            return $return->status(false)
                ->statusCode(Response::HTTP_UNAUTHORIZED)
                ->message('EXPIRED_AUTHORIZATION_TOKEN')
                ->response();
        } catch (JWTException) {
            return $return->status(false)
                ->statusCode(Response::HTTP_UNAUTHORIZED)
                ->message('NOT_PROVIDED_AUTHORIZATION_TOKEN')
                ->response();
        }

        return $next($request);
    }
}
