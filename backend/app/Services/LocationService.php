<?php

namespace App\Services;

use App\Repositories\LocationRepository;
use App\Services\IpInfoService;

class LocationService
{
    private $locationRepository;
    private $ipInfoService;

    public function __construct(
        LocationRepository $locationRepository,
        IpInfoService $ipInfoService
    ) {
        $this->locationRepository = $locationRepository;
        $this->ipInfoService = $ipInfoService;
    }

    public function getLocationByIp($ipAddress)
    {

        $location = $this->locationRepository->findByIpAddress($ipAddress);

        if (!$location) {
            $locationData = $this->ipInfoService->getLocationInfo($ipAddress);

            if ($locationData) {
                $location = $this->locationRepository->create($locationData);
            }
        }

        return $location;
    }
}
