<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class IpInfoService
{
    private $baseUrl = 'https://ipinfo.io/';

    public function getLocationInfo($ipAddress)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('IPINFO_TOKEN')
        ])->get("{$this->baseUrl}{$ipAddress}/json");

//        dd($response);
        if ($response->successful()) {
            $data = $response->json();


            return [
                'ip_address' => $ipAddress,
                'country' => $data['country'] ?? null,
                'city' => $data['city'] ?? null,
                'region' => $data['region'] ?? null,
            ];
        }

        return null;
    }
}
