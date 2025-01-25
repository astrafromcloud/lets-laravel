<?php

namespace App\Repositories;

use App\Models\Location;

class LocationRepository
{
    public function findByIpAddress($ipAddress)
    {
        return Location::where('ip_address', $ipAddress)->first();
    }

    public function create(array $data)
    {
        return Location::create($data);
    }

    public function update(Location $location, array $data)
    {
        $location->update($data);
        return $location;
    }

    public function delete(Location $location)
    {
        return $location->delete();
    }

    public function getAllLocations()
    {
        return Location::paginate(10);
    }
}
