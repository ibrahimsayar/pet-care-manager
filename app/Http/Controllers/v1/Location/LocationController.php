<?php

namespace App\Http\Controllers\v1\Location;

use App\Http\Controllers\Controller;
use App\Interfaces\v1\Location\LocationRepositoryInterface;
use App\Services\ResponseService;
use Illuminate\Http\JsonResponse;

class LocationController extends Controller
{
    private LocationRepositoryInterface $locationRepository;

    protected ResponseService $return;

    /**
     * @param  LocationRepositoryInterface  $locationRepository
     * @param  ResponseService  $return
     */
    public function __construct(
        LocationRepositoryInterface $locationRepository,
        ResponseService $return,
    ) {
        $this->locationRepository = $locationRepository;
        $this->return = $return;
    }

    /**
     * @return JsonResponse
     */
    public function cities(): JsonResponse
    {
        $city = $this
            ->locationRepository
            ->cities();

        return $this->return
            ->message('SUCCESS')
            ->data($city)
            ->response();
    }

    /**
     * @return JsonResponse
     */
    public function districts(): JsonResponse
    {
        $districts = $this
            ->locationRepository
            ->districts();

        return $this->return
            ->message('SUCCESS')
            ->data($districts)
            ->response();
    }
}
