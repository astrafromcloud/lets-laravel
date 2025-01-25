@extends('layouts.app')

@section('content')
    <div class="bg-white rounded-lg shadow p-6">
        <h1 class="text-2xl font-bold mb-6">Location Tracker</h1>

        <!-- Current Location -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-4">Current Location (IP: {{ $selectedIp }})</h2>
            @if($currentLocation)
                <div class="bg-gray-50 p-4 rounded">
                    <p><strong>Country:</strong> {{ $currentLocation->country }}</p>
                    <p><strong>Region:</strong> {{ $currentLocation->region }}</p>
                    <p><strong>City:</strong> {{ $currentLocation->city }}</p>
                </div>
            @else
                <p class="text-gray-500">No location data available</p>
            @endif
        </div>

        <!-- IP Address Form -->
        <form action="{{ route('locations.index') }}" method="GET" class="mb-8">
            <div class="flex gap-4">
                <input type="text"
                       name="ip_address"
                       value="{{ $selectedIp }}"
                       placeholder="Enter IP address"
                       class="flex-1 border rounded p-2">
                <button type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Look up IP
                </button>
            </div>
        </form>

        <!-- Saved Locations -->
        <h2 class="text-xl font-semibold mb-4">Saved Locations</h2>
        @if($locations->count() > 0)
            <div class="grid gap-4">
                @foreach($locations as $location)
                    <div class="bg-gray-50 p-4 rounded flex justify-between items-center">
                        <div>
                            <p><strong>IP:</strong> {{ $location->ip_address }}</p>
                            <p><strong>Location:</strong> {{ $location->city }}, {{ $location->region }}, {{ $location->country }}</p>
                        </div>
                        <div class="flex gap-2">
                            <form action="{{ route('locations.destroy', $location) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500">No saved locations</p>
        @endif
    </div>
@endsection
