<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

class ApiStatusController extends Controller
{
    public function fetchData()
    {
        // Path to the JSON file with file_oblast data
        $jsonFilePath = storage_path('app/file_oblast_data.json');

        // Check if the file exists
        if (!file_exists($jsonFilePath)) {
            return response()->json(['error' => 'File not found'], 404);
        }

        // Read and decode the JSON file
        $fileOblastData = json_decode(file_get_contents($jsonFilePath), true);

        // Count the number of items
        $urlCount = is_array($fileOblastData) ? count($fileOblastData) : 0;

        return response()->json(['url_count' => $urlCount]);
    }

}
