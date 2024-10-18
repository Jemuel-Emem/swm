<?php

namespace App\Http\Controllers;

use App\Models\Barangay;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GeoJsonController extends Controller
{
    public function getBarangaysGeoJson(): JsonResponse
    {
        $barangays = Barangay::all(['name', 'latitude', 'longitude']); // Adjust field names as necessary

        $features = $barangays->map(function ($barangay) {
            return [
                'type' => 'Feature',
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [(float)$barangay->longitude, (float)$barangay->latitude],
                ],
                'properties' => [
                    'name' => $barangay->name,
                ],
            ];
        });

        return response()->json([
            'type' => 'FeatureCollection',
            'features' => $features,
        ]);
    }
}
