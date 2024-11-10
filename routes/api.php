<?php

use App\Http\Controllers\GeoJsonController;
use App\Models\Barangay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/api/violation-count/{barangayName}', function ($barangayName) {
    // Query the Barangay model based on the barangay name
    $barangay = Barangay::where('name', $barangayName)->first();

    if ($barangay) {
        // Assuming you have a method to calculate the violation count, for example:
        $violationCount = $barangay->complaints()->count(); // Example: assuming violations is a relationship
        
        return response()->json([
            'violation_count' => $violationCount
        ]);
    }

    return response()->json(['violation_count' => 0]);
});
