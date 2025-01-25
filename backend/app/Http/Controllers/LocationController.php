<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use App\Services\LocationService;
use App\Repositories\LocationRepository;

class LocationController extends Controller
{
    private $locationService;
    private $locationRepository;

    public function __construct(
        LocationService $locationService,
        LocationRepository $locationRepository
    ) {
        $this->locationService = $locationService;
        $this->locationRepository = $locationRepository;
    }

    public function index(Request $request)
    {
        // Get client IP or use custom IP
//        $ipAddress = $request->input('ip_address', $request->ip());
        $ipAddress = '82.200.244.4';

        $currentLocation = $this->locationService->getLocationByIp($ipAddress);
        $locations = $this->locationRepository->getAllLocations();

        return view('locations.index', [
            'currentLocation' => $currentLocation,
            'locations' => $locations,
            'selectedIp' => $ipAddress
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate(Location::rules());
        $this->locationRepository->create($validatedData);

        return redirect()->route('locations.index')->with('success', 'Location added successfully');
    }

    public function update(Request $request, Location $location)
    {
        $validatedData = $request->validate(Location::rules());
        $this->locationRepository->update($location, $validatedData);

        return redirect()->route('locations.index')->with('success', 'Location updated successfully');
    }

    public function destroy(Location $location)
    {
        $this->locationRepository->delete($location);

        return redirect()->route('locations.index')->with('success', 'Location deleted successfully');
    }
}
